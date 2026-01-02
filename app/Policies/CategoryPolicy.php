<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->currentWorkspace->categories()->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return $category->workspace->is($user->currentWorkspace);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //This code allows people from the current workspace to create category
        return $user->currentWorkspace->categories()->exists();
        //Commenting this due to inability to apply billing
        //  return $user->isSubscribed();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {

        return ! $category->is_system && $category->workspace->is($user->currentWorkspace);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return ! $category->is_system && $category->workspace->is($user->currentWorkspace);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(): bool
    {
        return false;
    }
}
