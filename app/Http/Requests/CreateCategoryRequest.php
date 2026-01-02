<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Finance\CategoryClassification;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Enums\Finance\CategoryIcons;
use Illuminate\Validation\Rule;

final class CreateCategoryRequest extends FormRequest
{
    protected $errorBag = 'createCategory';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Category::class) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query
                        ->where('workspace_id', request()->user()->current_workspace_id)
                        ->where('classification', $this->get('classification'));
                }),],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
            'color' => ['required', 'hex_color'],
            'description' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255', Rule::in(CategoryIcons::casesAsValues())],
            'classification' => ['required', 'string', Rule::enum(CategoryClassification::class)],
            'parent_id' => [
                'nullable',
                'exists:categories,public_id',
                function ($attribute, $value, callable $fail): void {
                    if (! $value) {
                        return;
                    }

                    $parent = Category::where('public_id', $value)
                        ->where(function ($query) {
                            $query->where('workspace_id', request()->user()->current_workspace_id)
                                ->orWhere('is_system', true);
                        })
                        ->first();

                    if (! $parent) {
                        $fail('The selected parent category does not exist.');
                        return;
                    }

                    if ($parent->parent_id !== null) {
                        $fail('You cannot create nested categories more than two levels deep.');
                        return;
                    }
                },
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    public function prepareForValidation(): void
    {
        $input = $this->all();
        $snakeCaseInput = [];

        foreach ($input as $key => $value) {
            $snakeCaseInput[Str::snake($key)] = $value;
        }

        $this->replace($snakeCaseInput);

        $this->merge([
            'slug' => Str::slug(type($this->name)->asString()),
        ]);
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization(): RedirectResponse
    {
        return to_route('categories.index');
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'A category with this name already exists in the same classification.',
        ];
    }
}
