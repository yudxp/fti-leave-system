<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ResearchGroup;
use App\Models\User;

class ResearchGroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ResearchGroup');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ResearchGroup $researchgroup): bool
    {
        return $user->checkPermissionTo('view ResearchGroup');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ResearchGroup');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ResearchGroup $researchgroup): bool
    {
        return $user->checkPermissionTo('update ResearchGroup');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ResearchGroup $researchgroup): bool
    {
        return $user->checkPermissionTo('delete ResearchGroup');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ResearchGroup');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ResearchGroup $researchgroup): bool
    {
        return $user->checkPermissionTo('restore ResearchGroup');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ResearchGroup');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, ResearchGroup $researchgroup): bool
    {
        return $user->checkPermissionTo('replicate ResearchGroup');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder ResearchGroup');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ResearchGroup $researchgroup): bool
    {
        return $user->checkPermissionTo('force-delete ResearchGroup');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ResearchGroup');
    }
}
