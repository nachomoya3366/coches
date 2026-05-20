<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Cliente eliminado con éxito')
                    ->body('El cliente fue eliminado exitosamente')
                    ->success()
            ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // redirigir a la lista de libros
    }


    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function afterSave() {
        Notification::make()
            ->title("Cliente actualizado con éxito")
            ->body("El cliente fue actualizado exitosamente")
            ->success()
            ->send();
    }
}
