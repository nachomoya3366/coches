<?php

namespace App\Filament\Resources\Coches\Pages;

use App\Filament\Resources\Coches\CocheResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCoche extends ViewRecord
{
    protected static string $resource = CocheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
