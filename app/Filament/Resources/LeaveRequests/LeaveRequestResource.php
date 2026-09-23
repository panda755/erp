<?php

namespace App\Filament\Resources\LeaveRequests;

use App\Filament\Resources\LeaveRequests\Pages\CreateLeaveRequest;
use App\Filament\Resources\LeaveRequests\Pages\ListLeaveRequests;
use App\Filament\Resources\LeaveRequests\Pages\ViewLeaveRequest;
use App\Filament\Resources\LeaveRequests\Schemas\LeaveRequestForm;
use App\Filament\Resources\LeaveRequests\Tables\LeaveRequestsTable;
use App\Models\LeaveRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;
    protected static string|UnitEnum|null   $navigationGroup = 'Human Resource Management';
    protected static ?int                   $navigationSort = 4;
    protected static ?string                $modelLabel = 'Pengajuan Cuti';
    protected static ?string                $pluralModelLabel = 'Pengajuan Cuti';

    public static function form(Schema $schema): Schema
    {
        return LeaveRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeaveRequestsTable::configure($table);
    }

    /**
     * Employee hanya bisa melihat pengajuan milik sendiri.
     * Superadmin melihat semua.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->hasRole('super_admin')) {
            return $query;
        }

        return $query->where(
            'employee_id',
            auth()->user()?->employee?->id ?? 0
        );
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListLeaveRequests::route('/'),
            'create' => CreateLeaveRequest::route('/create'),
            'view'   => ViewLeaveRequest::route('/{record}'),
        ];
    }
}