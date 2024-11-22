<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApprovalFlow;

class ApprovalFlowPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ApprovalFlow');
    }

    public function view(User $user, ApprovalFlow $approvalFlow): bool
    {
        return $user->checkPermissionTo('view ApprovalFlow');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ApprovalFlow');
    }

    public function update(User $user, ApprovalFlow $approvalFlow): bool
    {
        return $user->checkPermissionTo('update ApprovalFlow');
    }

    public function delete(User $user, ApprovalFlow $approvalFlow): bool
    {
        return $user->checkPermissionTo('delete ApprovalFlow');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ApprovalFlow');
    }

    public function restore(User $user, ApprovalFlow $approvalFlow): bool
    {
        return $user->checkPermissionTo('restore ApprovalFlow');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ApprovalFlow');
    }

    public function forceDelete(User $user, ApprovalFlow $approvalFlow): bool
    {
        return $user->checkPermissionTo('force-delete ApprovalFlow');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ApprovalFlow');
    }
}
