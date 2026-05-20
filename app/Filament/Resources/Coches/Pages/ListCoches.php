<?php

namespace App\Filament\Resources\Coches\Pages;

use App\Filament\Resources\Coches\CocheResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoches extends ListRecords
{
    protected static string $resource = CocheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
