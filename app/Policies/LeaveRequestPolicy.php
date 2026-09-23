<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\LeaveRequest;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class LeaveRequestPolicy
{
    use HandlesAuthorization;

    /** Kedua role boleh mengakses halaman list */
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->hasAnyRole(['super_admin', 'Employee']);
    }

    /**
     * Superadmin boleh lihat semua.
     * Employee hanya boleh lihat milik sendiri.
     */
    public function view(AuthUser $authUser, LeaveRequest $leaveRequest): bool
    {
        if ($authUser->hasRole('super_admin')) {
            return true;
        }

        return $authUser->hasRole('Employee')
            && $authUser->employee?->id === $leaveRequest->Employee_id;
    }

    /** Kedua role boleh membuat pengajuan */
    public function create(AuthUser $authUser): bool
    {
        return $authUser->hasAnyRole(['super_admin', 'Employee']);
    }

    /** Tidak ada halaman edit — approve/reject ditangani via Action */
    public function update(AuthUser $authUser, LeaveRequest $leaveRequest): bool
    {
        return false;
    }

    public function delete(AuthUser $authUser, LeaveRequest $leaveRequest): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function restore(AuthUser $authUser, LeaveRequest $leaveRequest): bool
    {
        return false;
    }

    public function forceDelete(AuthUser $authUser, LeaveRequest $leaveRequest): bool
    {
        return $authUser->hasRole('super_admin');
    }
}