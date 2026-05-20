<?php

namespace App\Filament\Resources\Transacciones\Pages;

use App\Filament\Resources\Transacciones\TransaccionesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditTransacciones extends EditRecord
{
    protected static string $resource = TransaccionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Transacción eliminada con éxito')
                    ->body('La transacción fue eliminada exitosamente')
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
            ->title("Transacción actualizada con éxito")
            ->body("La transacción fue actualizada exitosamente")
            ->success()
            ->send();
    }
}
