<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any LeaveRequest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveRequest $leaverequest): bool
    {
        return $user->checkPermissionTo('view LeaveRequest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create LeaveRequest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LeaveRequest $leaverequest): bool
    {
        return $user->checkPermissionTo('update LeaveRequest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeaveRequest $leaverequest): bool
    {
        return $user->checkPermissionTo('delete LeaveRequest');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any LeaveRequest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveRequest $leaverequest): bool
    {
        return $user->checkPermissionTo('restore LeaveRequest');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any LeaveRequest');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, LeaveRequest $leaverequest): bool
    {
        return $user->checkPermissionTo('replicate LeaveRequest');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder LeaveRequest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveRequest $leaverequest): bool
    {
        return $user->checkPermissionTo('force-delete LeaveRequest');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any LeaveRequest');
    }
}
