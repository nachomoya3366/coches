<?php

namespace App\Filament\Resources\Coches;

use App\Filament\Resources\Coches\Pages\CreateCoche;
use App\Filament\Resources\Coches\Pages\EditCoche;
use App\Filament\Resources\Coches\Pages\ListCoches;
use App\Filament\Resources\Coches\Pages\ViewCoche;
use App\Filament\Resources\Coches\Schemas\CocheForm;
use App\Filament\Resources\Coches\Schemas\CocheInfolist;
use App\Filament\Resources\Coches\Tables\CochesTable;
use App\Models\Coche;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CocheResource extends Resource
{
    protected static ?string $model = Coche::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Coche';

    public static function form(Schema $schema): Schema
    {
        return CocheForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CocheInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CochesTable::configure($table)
            ->defaultSort('created_at', 'desc')
            ->persistSortInSession()
            ->filters([
                SelectFilter::make('estado')
                    ->options([
                        'stock' => 'En Stock',
                        'vendido' => 'Vendido',
                    ]),
                SelectFilter::make('marca')
                    ->multiple()
                    ->options(fn () => Coche::query()->distinct()->whereNotNull('marca')->pluck('marca', 'marca')->toArray()),
                Filter::make('precio_venta')
                    ->form([
                        TextInput::make('min_price')->numeric()->label('Precio Mínimo'),
                        TextInput::make('max_price')->numeric()->label('Precio Máximo'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['min_price'], fn ($q) => $q->whereRaw('precio_compra * 1.10 >= ?', [$data['min_price']]))
                            ->when($data['max_price'], fn ($q) => $q->whereRaw('precio_compra * 1.10 <= ?', [$data['max_price']]));
                    }),
                Filter::make('kilometros')
                    ->form([
                        TextInput::make('max_km')->numeric()->label('KM Máximos'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['max_km'], fn ($q) => $q->where('kilometros', '<=', $data['max_km']));
                    }),
                Filter::make('año')
                    ->form([
                        TextInput::make('min_year')->numeric()->label('Año Desde'),
                        TextInput::make('max_year')->numeric()->label('Año Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['min_year'], fn ($q) => $q->where('año', '>=', $data['min_year']))
                            ->when($data['max_year'], fn ($q) => $q->where('año', '<=', $data['max_year']));
                    }),
                SelectFilter::make('combustible')
                    ->multiple()
                    ->options([
                        'gasolina' => 'Gasolina',
                        'diesel' => 'Diesel',
                    ]),
                SelectFilter::make('color')
                    ->multiple()
                    ->options(fn () => Coche::query()->distinct()->whereNotNull('color')->pluck('color', 'color')->toArray()),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCoches::route('/'),
            'create' => CreateCoche::route('/create'),
            'view' => ViewCoche::route('/{record}'),
            'edit' => EditCoche::route('/{record}/edit'),
        ];
    }
}
