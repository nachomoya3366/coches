<?php

namespace App\Filament\Resources\Proveedores\Pages;

use App\Filament\Resources\Proveedores\ProveedoreResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateProveedore extends CreateRecord
{
    protected static string $resource = ProveedoreResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // redirigir a la lista de libros
    }


    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    protected function afterCreate() {
        Notification::make()
            ->title("Proveedor creado con éxito")
            ->body("El proveedor fue creado exitosamente")
            ->success()
            ->send();
    }
}
