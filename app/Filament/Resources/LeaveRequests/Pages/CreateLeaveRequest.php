<?php

namespace App\Filament\Resources\LeaveRequests\Pages;

use App\Filament\Resources\LeaveRequests\LeaveRequestResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLeaveRequest extends CreateRecord
{
    protected static string $resource = LeaveRequestResource::class;

    /**
     * Pastikan employee_id selalu terisi dengan ID employee yang login,
     * terlepas dari apakah field tersebut tersembunyi di form atau tidak.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! auth()->user()->hasRole('super_admin')) {
            $data['employee_id'] = auth()->user()->employee?->id;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Pengajuan cuti berhasil dikirim')
            ->body('Pengajuan Anda sedang menunggu persetujuan superadmin.')
            ->success();
    }
}