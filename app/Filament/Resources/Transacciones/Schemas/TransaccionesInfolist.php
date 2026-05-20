<?php

namespace App\Filament\Resources\Transacciones\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransaccionesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('coche_id')
                    ->numeric(),
                TextEntry::make('proveedor_id')
                    ->numeric(),
                TextEntry::make('cliente_id')
                    ->numeric(),
                TextEntry::make('accion'),
                TextEntry::make('precio')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
