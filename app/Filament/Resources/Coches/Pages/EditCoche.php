<?php

namespace App\Filament\Resources\Coches\Pages;

use App\Filament\Resources\Coches\CocheResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCoche extends EditRecord
{
    protected static string $resource = CocheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Coche eliminado con éxito')
                    ->body('El coche fue eliminado exitosamente')
                    ->success()
            ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // redirigir a la lista de coches
    }


    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function afterSave() {
        Notification::make()
            ->title("Coche actualizado con éxito")
            ->body("El coche fue actualizado exitosamente")
            ->success()
            ->send();
    }
}
