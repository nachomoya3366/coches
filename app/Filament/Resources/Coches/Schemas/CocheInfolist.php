<?php

namespace App\Filament\Resources\Coches\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CocheInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('imagen')
                    ->label('Imagen del coche')
                    ->disk('public')
                    ->height(200),
                TextEntry::make('matricula')
                    ->label('Matrícula'),
                TextEntry::make('marca')
                    ->label('Marca'),
                TextEntry::make('modelo')
                    ->label('Modelo'),
                TextEntry::make('color')
                    ->label('Color'),
                TextEntry::make('año')
                    ->label('Año')
                    ->numeric(),
                TextEntry::make('kilometros')
                    ->label('Kilómetros')
                    ->numeric(),
                TextEntry::make('combustible'),
                TextEntry::make('proveedor.nombre')
                    ->label('Proveedor'),
                TextEntry::make('precio_compra')
                    ->label('Precio de compra')
                    ->money('EUR'),
                TextEntry::make('created_at')
                    ->label('Fecha de registro')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
