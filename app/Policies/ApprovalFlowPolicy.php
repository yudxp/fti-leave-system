<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ApprovalFlow;
use App\Models\User;

class ApprovalFlowPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ApprovalFlow');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ApprovalFlow $approvalflow): bool
    {
        return $user->checkPermissionTo('view ApprovalFlow');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ApprovalFlow');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ApprovalFlow $approvalflow): bool
    {
        return $user->checkPermissionTo('update ApprovalFlow');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ApprovalFlow $approvalflow): bool
    {
        return $user->checkPermissionTo('delete ApprovalFlow');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ApprovalFlow');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ApprovalFlow $approvalflow): bool
    {
        return $user->checkPermissionTo('restore ApprovalFlow');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ApprovalFlow');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, ApprovalFlow $approvalflow): bool
    {
        return $user->checkPermissionTo('replicate ApprovalFlow');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder ApprovalFlow');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ApprovalFlow $approvalflow): bool
    {
        return $user->checkPermissionTo('force-delete ApprovalFlow');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ApprovalFlow');
    }
}
