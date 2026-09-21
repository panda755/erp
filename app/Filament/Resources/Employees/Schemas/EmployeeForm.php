<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::all()->pluck('name', 'id'))
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(fn($set) => $set('position_id', null)),
                Select::make('position_id')
                    ->label('Position')
                    ->options(fn($get) => Position::where('department_id', $get('department_id'))
                        ->pluck('name', 'id'))
                    ->searchable(),
                Select::make('gender')
                    ->options([
                        'male'   => 'Male',
                        'female' => 'Female',
                    ]),
                Select::make('religion')
                    ->options([
                        'muslim'    => 'Muslim',
                        'christian' => 'Christian',
                        'catholic'  => 'Catholic',
                        'hindu'     => 'Hindu',
                        'buddha'    => 'Buddha',
                    ]),
                TextInput::make('address'),
                TextInput::make('place_of_birth'),
                TextInput::make('date_of_birth'),
                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('salary')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Select::make('status')
                    ->options([
                        'applicant' => 'Applicant',
                        'active'    => 'Active',
                        'trainee'   => 'Trainee',
                        'Former'         => 'Former',
                    ])
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->directory('employees'),
            ]);
    }
}
