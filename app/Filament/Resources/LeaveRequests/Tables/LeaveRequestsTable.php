<?php

namespace App\Filament\Resources\LeaveRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeaveRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom nama karyawan hanya ditampilkan untuk superadmin
                TextColumn::make('employee.user.name')
                    ->label('Karyawan')
                    ->searchable()
                    ->sortable()
                    ->hidden(fn() => ! auth()->user()->hasRole('super_admin')),

                TextColumn::make('leaveType.name')
                    ->label('Jenis Cuti')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('total_days')
                    ->label('Hari')
                    ->suffix(' hari')
                    ->alignCenter(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'submitted' => 'warning',
                        'approved'  => 'success',
                        'rejected'  => 'danger',
                        'cancelled' => 'gray',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'submitted' => 'Menunggu',
                        'approved'  => 'Disetujui',
                        'rejected'  => 'Ditolak',
                        'cancelled' => 'Dibatalkan',
                        default     => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'submitted' => 'Menunggu',
                        'approved'  => 'Disetujui',
                        'rejected'  => 'Ditolak',
                        'cancelled' => 'Dibatalkan',
                    ]),

                SelectFilter::make('leave_type_id')
                    ->label('Jenis Cuti')
                    ->relationship('leaveType', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}