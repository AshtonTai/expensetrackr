<?php

declare(strict_types=1);

namespace App\Actions\Categories;

use App\Models\Category;
use App\Models\User;

final class CreateCategory
{
    /**
     * Create a new category.
     *
     * @param  array<string, mixed>  $input
     */
    public function handle(User $user, array $input): Category
    {
        $parentId = null;
        if (! empty($input['parent_id'])) {
            $parent = Category::where('public_id', $input['parent_id'])
                ->where(function ($query) use ($user) {
                    // Allow parents that are either:
                    // - in the user's workspace, OR
                    // - system categories (which have workspace_id = NULL)
                    $query->where('workspace_id', $user->current_workspace_id)
                        ->orWhere('is_system', true);
                })
                ->first();

            if (! $parent) {
                throw new \InvalidArgumentException('Invalid parent category.');
            }

            $parentId = $parent->id;
        }

        return Category::create([
            'name' => $input['name'],
            'slug' => $input['slug'],
            'color' => $input['color'],
            'description' => $input['description'] ?? null,
            'icon' => $input['icon'] ?? null,
            'classification' => $input['classification'],
            'parent_id' => $parentId,
            'is_system' => false,
            'workspace_id' => $user->current_workspace_id,
        ]);
    }
}
