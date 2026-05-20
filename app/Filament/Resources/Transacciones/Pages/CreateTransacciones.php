<?php

namespace App\Filament\Resources\Transacciones\Pages;

use App\Filament\Resources\Transacciones\TransaccionesResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateTransacciones extends CreateRecord
{
    protected static string $resource = TransaccionesResource::class;

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
            ->title("Transacción creada con éxito")
            ->body("La transacción fue creado exitosamente")
            ->success()
            ->send();
    }
}
