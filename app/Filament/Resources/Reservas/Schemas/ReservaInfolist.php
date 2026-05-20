<?php

namespace App\Filament\Resources\Reservas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReservaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('coche_id')
                    ->numeric(),
                TextEntry::make('fecha')
                    ->date(),
                TextEntry::make('hora')
                    ->time(),
                TextEntry::make('nombre_cliente')
                    ->placeholder('-'),
                TextEntry::make('telefono')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
