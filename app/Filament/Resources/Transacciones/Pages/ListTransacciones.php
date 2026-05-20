<?php

namespace App\Filament\Resources\Transacciones\Pages;

use App\Filament\Resources\Transacciones\TransaccionesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransacciones extends ListRecords
{
    protected static string $resource = TransaccionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
