<?php

namespace App\Filament\Resources\Transacciones\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class TransaccionesForm
{
    public static function configure(Schema $schema): Schema
    {
       return $schema
            ->components([
                Select::make('coche_id')
                    ->relationship('coche', 'matricula')
                    ->preload()
                    ->required(),

                Select::make('proveedor_id')
                    ->relationship('proveedor', 'nombre')
                    ->preload()
                    ->required(),

                Select::make('cliente_id')
                    ->relationship('cliente', 'nombre')
                    ->preload()
                    ->required(),

                Select::make('accion')
                    ->options([
                        'comprar' => 'Comprar',
                        'vender' => 'Vender',
                    ])
                    ->required(),

                TextInput::make('precio')
                    ->required()
                    ->numeric(),

                DatePicker::make('fecha')
                    ->default(now())
                    ->required(),
        ]);
    }
}
