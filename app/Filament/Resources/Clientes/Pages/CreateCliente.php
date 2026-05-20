<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

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
            ->title("Cliente creado con éxito")
            ->body("El cliente fue creado exitosamente")
            ->success()
            ->send();
    }
}
