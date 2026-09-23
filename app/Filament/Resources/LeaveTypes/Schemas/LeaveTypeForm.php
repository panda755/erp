<?php

namespace App\Filament\Resources\LeaveTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LeaveTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Nama Jenis Cuti')
                ->required()
                ->maxLength(100),

            TextInput::make('default_quota')
                ->label('Kuota Default (hari/tahun)')
                ->required()
                ->numeric()
                ->default(12)
                ->minValue(0)
                ->suffix('hari'),

            TextInput::make('max_consecutive_days')
                ->label('Maks. Hari Berturut-turut')
                ->numeric()
                ->nullable()
                ->suffix('hari')
                ->helperText('Kosongkan jika tidak ada batasan.'),

            Toggle::make('is_paid')
                ->label('Cuti Berbayar')
                ->default(true),

            Toggle::make('requires_attachment')
                ->label('Wajib Lampiran')
                ->default(false)
                ->helperText('Jika aktif, karyawan wajib mengunggah dokumen saat mengajukan.'),
        ]);
    }
}