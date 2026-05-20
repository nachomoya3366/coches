<?php

namespace App\Filament\Resources\Reservas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ReservaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('coche_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('fecha')
                    ->required(),
                TimePicker::make('hora')
                    ->required(),
                TextInput::make('nombre_cliente'),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
            ]);
    }
}
