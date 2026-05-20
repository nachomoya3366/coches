<?php

namespace App\Filament\Resources\Proveedores\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProveedoreInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tipo'),
                TextEntry::make('CIF/NIF'),
                TextEntry::make('nombre'),
                TextEntry::make('telefono')
                    ->numeric(),
                TextEntry::make('direccion'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
