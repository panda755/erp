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
                Select::make('user_id')
                    ->label('Nama (Akun User)')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
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
                DatePicker::make('date_of_birth')
                    ->label('Tanggal Lahir')
                    ->maxDate(now()->subYears(15))   // cegah input usia tidak masuk akal
                    ->displayFormat('d/m/Y')
                    ->native(false),

                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('salary')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('start_date')
                    ->label('Tanggal Mulai Kerja')
                    ->maxDate(now())                 // tidak boleh mulai kerja di masa depan
                    ->displayFormat('d/m/Y')
                    ->native(false),
                DatePicker::make('end_date')
                    ->label('Tanggal Berhenti')
                    ->afterOrEqual('start_date')     // tidak boleh berhenti sebelum mulai kerja
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->visible(fn($get) => $get('status') === 'former'),
                Select::make('status')
                    ->options([
                        'applicant' => 'Applicant',
                        'active'    => 'Active',
                        'trainee'   => 'Trainee',
                        'former'         => 'Former',
                    ])
                    ->required()
                    ->live(),
                FileUpload::make('image')
                    ->image()
                    ->directory('employees'),
            ]);
    }
}
