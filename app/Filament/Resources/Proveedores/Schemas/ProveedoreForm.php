<?php

namespace App\Filament\Resources\Proveedores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;

class ProveedoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
           ->components([
                Select::make('tipo')
                    ->options([
                        'persona' => 'Persona',
                        'empresa' => 'Empresa',
                    ])
                    ->reactive()
                    ->required(),
                TextInput::make('CIF/NIF')
                    ->label(fn ($get) =>
                        $get('tipo') === 'empresa' ? 'CIF' : 'NIF'
                    )
                    ->placeholder(fn ($get) =>
                        $get('tipo') === 'empresa'
                            ? 'Introduce CIF (ej: B12345678)'
                            : 'Introduce NIF (ej: 12345678A)'
                    )
                    ->visible(fn ($get) => filled($get('tipo')))
                    ->required(fn ($get) => filled($get('tipo')))
                    ->unique('proveedores', 'CIF/NIF'),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->numeric(),
                TextInput::make('direccion')
                    ->required(),
            ]);
    }
}
