<?php

namespace App\Filament\Resources\Transacciones\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaccionesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Número')
                    ->rowIndex()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('coche.matricula')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('proveedor.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cliente.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('accion')
                    ->searchable(),
                TextColumn::make('precio')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
