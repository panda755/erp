<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\LeaveType;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class LeaveTypePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function view(AuthUser $authUser, LeaveType $leaveType): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function update(AuthUser $authUser, LeaveType $leaveType): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function delete(AuthUser $authUser, LeaveType $leaveType): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function restore(AuthUser $authUser, LeaveType $leaveType): bool
    {
        return false;
    }

    public function forceDelete(AuthUser $authUser, LeaveType $leaveType): bool
    {
        return $authUser->hasRole('super_admin');
    }
}