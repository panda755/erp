<?php

namespace App\Filament\Resources\LeaveTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeaveTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('default_quota')
                    ->label('Kuota Default')
                    ->suffix(' hari')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('max_consecutive_days')
                    ->label('Maks. Berturut-turut')
                    ->suffix(' hari')
                    ->alignCenter()
                    ->placeholder('-'),

                IconColumn::make('is_paid')
                    ->label('Berbayar')
                    ->boolean()
                    ->alignCenter(),

                IconColumn::make('requires_attachment')
                    ->label('Wajib Lampiran')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}