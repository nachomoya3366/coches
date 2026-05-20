<?php

namespace App\Filament\Resources\Proveedores\Pages;

use App\Filament\Resources\Proveedores\ProveedoreResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditProveedore extends EditRecord
{
    protected static string $resource = ProveedoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Proveedor eliminado con éxito')
                    ->body('El proveedor fue eliminado exitosamente')
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
            ->title("Proveedor actualizado con éxito")
            ->body("El proveedor fue actualizado exitosamente")
            ->success()
            ->send();
    }
}
