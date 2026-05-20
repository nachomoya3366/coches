<?php

namespace App\Filament\Resources\Coches\Pages;

use App\Filament\Resources\Coches\CocheResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCoche extends CreateRecord
{
    protected static string $resource = CocheResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // redirigir a la lista de coches
    }


    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    protected function afterCreate() {
        Notification::make()
            ->title("Coche creado con éxito")
            ->body("El coche fue creado exitosamente")
            ->success()
            ->send();

        $coche = $this->record;
        $coche->transacciones()->create([
            'coche_id'     => $coche->id,
            'proveedor_id' => $coche->proveedore_id,
            'cliente_id'   => null,
            'accion'       => 'compra',
            'precio'       => $coche->precio_compra, 
            'fecha'        => now(),
        ]);
    }
}
