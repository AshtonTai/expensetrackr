<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Finance\CategoryClassification;
use App\Enums\Finance\CategoryIcons;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

final class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->category) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'hex_color'],
            'description' => ['nullable', 'string', 'max:255'],
            'icon' => [
                'nullable',
                'string',
                'max:255',
                Rule::in(CategoryIcons::casesAsValues())
            ],
            'classification' => ['required', 'string', Rule::enum(CategoryClassification::class)],
            'parent_id' => [
                'nullable',
                'exists:categories,public_id',
                function ($attribute, $value, callable $fail): void {

                    if (! $value) {
                        return;
                    }

                    $current = $this->route('category');
                    $parent = Category::where('public_id', $value)->first();

                    if (! $parent) {
                        $fail('The selected parent category does not exist.');
                        return;
                    }


                    // Prevent self-parenting
                    if ($current && $current->public_id === $value) {
                        $fail('A category cannot be its own parent.');
                        return;
                    }

                    // Parent must be top-level
                    if ($parent->parent_id !== null) {
                        $fail('You can only select a top-level category as a parent.');
                        return;
                    }

                    // Prevent assigning a parent if current already has children
                    if ($current && $current->children()->exists()) {
                        $fail('This category already has children and cannot be assigned a parent.');
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
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization(): RedirectResponse
    {
        return to_route('categories.index');
    }
}
