<?php

namespace App\Filament\Resources\Pagos\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use \Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;

class PagosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha')
                    ->dateTime()
                    ->sortable()
                    ->label('Fecha Compra'),
                TextColumn::make('coche.marca')->label('Marca'),
                TextColumn::make('coche.modelo')->label('Modelo'),
                TextColumn::make('nombre_cliente')
                    ->searchable()
                    ->label('Cliente'),
                TextColumn::make('precio')
                    ->money('eur')
                    ->sortable(),
                TextColumn::make('numero_tarjeta')
                    ->label('Tarjeta')
                    ->formatStateUsing(fn (string $state): string => '**** **** **** ' . substr($state, -4)),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
