<?php

namespace App\Filament\Resources\LeaveRequests\Pages;

use App\Filament\Resources\LeaveRequests\LeaveRequestResource;
use App\Models\LeaveBalance;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewLeaveRequest extends ViewRecord
{
    protected static string $resource = LeaveRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol Setujui — hanya superadmin, hanya saat status masih 'submitted'
            Action::make('approve')
                ->label('Setujui')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->modalHeading('Setujui Pengajuan Cuti')
                ->modalDescription('Tindakan ini akan menyetujui pengajuan cuti dan memotong saldo cuti karyawan.')
                ->action(fn() => $this->handleApprove())
                ->visible(fn(): bool =>
                    $this->record->status === 'submitted' &&
                    auth()->user()->hasRole('super_admin')
                ),

            // Tombol Tolak — hanya superadmin, hanya saat status masih 'submitted'
            Action::make('reject')
                ->label('Tolak')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->form([
                    Textarea::make('rejection_reason')
                        ->label('Alasan Penolakan')
                        ->required()
                        ->rows(3),
                ])
                ->action(fn(array $data) => $this->handleReject($data))
                ->visible(fn(): bool =>
                    $this->record->status === 'submitted' &&
                    auth()->user()->hasRole('super_admin')
                ),

            // Tombol Batalkan — hanya employee pemilik, hanya saat status 'submitted'
            Action::make('cancel')
                ->label('Batalkan Pengajuan')
                ->color('gray')
                ->icon('heroicon-o-arrow-uturn-left')
                ->requiresConfirmation()
                ->modalHeading('Batalkan Pengajuan Cuti')
                ->modalDescription('Pengajuan yang dibatalkan tidak dapat diaktifkan kembali.')
                ->action(fn() => $this->handleCancel())
                ->visible(fn(): bool =>
                    $this->record->status === 'submitted' &&
                    ! auth()->user()->hasRole('super_admin') &&
                    auth()->user()->employee?->id === $this->record->employee_id
                ),
        ];
    }

    public function handleApprove(): void
    {
        $this->record->update([
            'status'      => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Kurangi saldo cuti karyawan; buat record balance jika belum ada
        LeaveBalance::firstOrCreate(
            [
                'employee_id'   => $this->record->employee_id,
                'leave_type_id' => $this->record->leave_type_id,
                'year'          => $this->record->start_date->year,
            ],
            [
                'quota' => $this->record->leaveType->default_quota,
                'used'  => 0,
            ]
        )->increment('used', $this->record->total_days);

        Notification::make()
            ->title('Pengajuan cuti disetujui')
            ->success()
            ->send();

        $this->redirect(
            LeaveRequestResource::getUrl('view', ['record' => $this->record->getKey()])
        );
    }

    public function handleReject(array $data): void
    {
        $this->record->update([
            'status'           => 'rejected',
            'rejection_reason' => $data['rejection_reason'],
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
        ]);

        Notification::make()
            ->title('Pengajuan cuti ditolak')
            ->danger()
            ->send();

        $this->redirect(
            LeaveRequestResource::getUrl('view', ['record' => $this->record->getKey()])
        );
    }

    public function handleCancel(): void
    {
        $this->record->update(['status' => 'cancelled']);

        Notification::make()
            ->title('Pengajuan cuti dibatalkan')
            ->warning()
            ->send();

        $this->redirect(LeaveRequestResource::getUrl('index'));
    }
}