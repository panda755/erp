<?php

namespace App\Filament\Resources\LeaveRequests\Schemas;

use App\Models\Employee;
use App\Models\Holiday;
use App\Models\LeaveType;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // Hanya superadmin yang memilih karyawan saat create.
            // Saat view, semua bisa melihat field ini.
            Select::make('employee_id')
                ->label('Karyawan')
                ->options(fn() => Employee::with('user')
                    ->get()
                    ->mapWithKeys(fn($e) => [$e->id => $e->user?->name ?? "Karyawan #{$e->id}"]))
                ->required()
                ->searchable()
                ->default(fn() => auth()->user()->employee?->id)
                ->hidden(fn(string $operation) =>
                    $operation === 'create' && ! auth()->user()->hasRole('super_admin')
                )
                ->dehydrated(true),

            Select::make('leave_type_id')
                ->label('Jenis Cuti')
                ->options(LeaveType::pluck('name', 'id'))
                ->required()
                ->live()
                ->preload(),

            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required()
                ->live()
                ->native(false)
                ->displayFormat('d/m/Y')
                ->minDate(now())
                ->afterStateUpdated(fn($set, $get) => static::hitungHariKerja($set, $get)),

            DatePicker::make('end_date')
                ->label('Tanggal Selesai')
                ->required()
                ->live()
                ->native(false)
                ->displayFormat('d/m/Y')
                ->afterOrEqual('start_date')
                ->afterStateUpdated(fn($set, $get) => static::hitungHariKerja($set, $get)),

            TextInput::make('total_days')
                ->label('Total Hari Kerja')
                ->numeric()
                ->readOnly()
                ->default(0)
                ->suffix('hari'),

            Textarea::make('reason')
                ->label('Alasan')
                ->rows(3)
                ->columnSpanFull(),

            // Lampiran hanya muncul jika jenis cuti membutuhkan lampiran
            FileUpload::make('attachment')
                ->label('Lampiran (PDF / Gambar)')
                ->directory('leave-attachments')
                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                ->nullable()
                ->visible(fn($get) =>
                    LeaveType::find($get('leave_type_id'))?->requires_attachment ?? false
                ),

            // Field di bawah ini hanya tampil pada halaman View (bukan Create)
            TextInput::make('status')
                ->label('Status')
                ->disabled()
                ->hidden(fn(string $operation) => $operation === 'create'),

            Textarea::make('rejection_reason')
                ->label('Alasan Penolakan')
                ->disabled()
                ->rows(2)
                ->columnSpanFull()
                ->hidden(fn(string $operation, $get) =>
                    $operation === 'create' || blank($get('rejection_reason'))
                ),
        ]);
    }

    /**
     * Hitung hari kerja: tidak termasuk Sabtu, Minggu, dan hari libur nasional.
     */
    protected static function hitungHariKerja($set, $get): void
    {
        $start = $get('start_date');
        $end   = $get('end_date');

        if (! $start || ! $end) {
            $set('total_days', 0);
            return;
        }

        $startDate = Carbon::parse($start);
        $endDate   = Carbon::parse($end);

        if ($endDate->lt($startDate)) {
            $set('total_days', 0);
            return;
        }

        $holidays = Holiday::pluck('date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->toArray();

        $days    = 0;
        $current = $startDate->copy();

        while ($current->lte($endDate)) {
            if (! $current->isWeekend() && ! in_array($current->format('Y-m-d'), $holidays)) {
                $days++;
            }
            $current->addDay();
        }

        $set('total_days', $days);
    }
}