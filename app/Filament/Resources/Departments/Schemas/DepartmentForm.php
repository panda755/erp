<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use League\Flysystem\Visibility;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Department Information')
                    ->icon('heroicon-o-building-storefront')
                    ->iconColor('primary')
                    ->description('Please fill in the department information below.')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('description')
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('phone_number')
                            ->tel()
                            ->required(),
                    ]),

                Section::make('Department Logo')
                    ->icon('heroicon-o-photo')
                    ->iconColor('primary')
                    ->description('Upload the department logo here.')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->disk('public')
                            ->directory('logos')
                            ->visibility(Visibility::PUBLIC),
                    ]),
            ])
            ->columns(4);
    }
}
