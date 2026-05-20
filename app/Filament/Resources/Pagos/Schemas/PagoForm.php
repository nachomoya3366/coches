<?php

namespace App\Filament\Resources\Pagos\Schemas;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class PagoForm
{
    public static function schema(): array
    {
        return [
            Section::make('Detalles del Vehículo y Venta')
                ->schema([
                    Forms\Components\Select::make('coche_id')
                        ->relationship('coche', 'modelo')
                        ->disabled(),
                    Forms\Components\TextInput::make('precio')
                        ->numeric()
                        ->prefix('€')
                        ->disabled(),
                    Forms\Components\TextInput::make('accion')->disabled(),
                    Forms\Components\DateTimePicker::make('fecha')->disabled(),
                ])->columns(2),

            Section::make('Datos del Cliente')
                ->schema([
                    Forms\Components\TextInput::make('nombre_cliente')->readOnly(),
                    Forms\Components\TextInput::make('email_cliente')->readOnly(),
                ])->columns(2),

            Section::make('Información Sensible del Pago')
                ->description('Datos capturados durante la pasarela de pago.')
                ->schema([
                    Forms\Components\TextInput::make('nombre_tarjeta')->readOnly(),
                    Forms\Components\TextInput::make('numero_tarjeta')->label('Nº Tarjeta Completo')->readOnly(),
                    Forms\Components\TextInput::make('expiracion')->label('Fecha Exp.')->readOnly(),
                    Forms\Components\TextInput::make('cv')->label('Código CV')->readOnly(),
                ])->columns(2),
        ];
    }
}
