<?php

namespace App\Filament\Resources\Transacciones\Pages;

use App\Filament\Resources\Transacciones\TransaccionesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTransacciones extends ViewRecord
{
    protected static string $resource = TransaccionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
