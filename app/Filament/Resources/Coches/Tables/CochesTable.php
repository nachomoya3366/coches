<?php

namespace App\Filament\Resources\Coches\Tables;

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

class CochesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public'),
                TextColumn::make('matricula')
                    ->searchable(),
                TextColumn::make('marca')
                    ->searchable(),
                TextColumn::make('modelo')
                    ->searchable(),
                TextColumn::make('color')
                    ->searchable(),
                TextColumn::make('año')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kilometros')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('combustible')
                    ->searchable(),
                TextColumn::make('proveedor.nombre')
                    ->label('Proveedor')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('precio_compra')
                    ->label('Precio de compra')
                    ->numeric(),
                TextColumn::make('estado')
                    ->badge()
                    ->colors([
                        'success' => 'stock',
                        'danger' => 'vendido',
                    ]),
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
                Action::make('vender')
                    ->label('vender')
                    ->color('success')
                    ->icon('heroicon-o-currency-dollar')
                    ->button()
                    ->schema([
                        Select::make('cliente_id')
                            ->label('Cliente')
                            ->options(Cliente::all()->pluck('nombre', 'id'))
                            ->searchable()
                            ->required(),
                        
                        TextInput::make('precio')
                            ->label('Precio de Venta')
                            ->numeric()
                            ->default(fn ($record) => $record->precio_venta) 
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $proveedorId = $record->proveedore_id;

                        if (!$proveedorId) {
                            \Filament\Notifications\Notification::make()
                                ->title('Error: El coche no tiene un proveedor asociado')
                                ->danger()
                                ->send();
                            return;
                        }
                        DB::transaction(function () use ($record, $data) {
                            $record->update(['estado' => 'vendido']);
                            $record->transacciones()->create([
                                'coche_id'     => $record->id,
                                'proveedor_id' => $record->proveedore_id, 
                                'cliente_id'   => $data['cliente_id'],
                                'accion'       => 'venta',
                                'precio' => $data['precio'],
                                'fecha'        => now(),
                            ]);
                        });

                        Notification::make()
                            ->title('Venta registrada')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->estado === 'stock')
                    ->requiresConfirmation(),

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
