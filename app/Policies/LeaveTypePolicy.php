<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\LeaveType;
use App\Models\User;

class LeaveTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any LeaveType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveType $leavetype): bool
    {
        return $user->checkPermissionTo('view LeaveType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create LeaveType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LeaveType $leavetype): bool
    {
        return $user->checkPermissionTo('update LeaveType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeaveType $leavetype): bool
    {
        return $user->checkPermissionTo('delete LeaveType');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any LeaveType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveType $leavetype): bool
    {
        return $user->checkPermissionTo('restore LeaveType');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any LeaveType');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, LeaveType $leavetype): bool
    {
        return $user->checkPermissionTo('replicate LeaveType');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder LeaveType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveType $leavetype): bool
    {
        return $user->checkPermissionTo('force-delete LeaveType');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any LeaveType');
    }
}
