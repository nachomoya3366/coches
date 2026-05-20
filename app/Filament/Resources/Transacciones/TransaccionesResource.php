<?php

namespace App\Filament\Resources\Transacciones;

use App\Filament\Resources\Transacciones\Pages\CreateTransacciones;
use App\Filament\Resources\Transacciones\Pages\EditTransacciones;
use App\Filament\Resources\Transacciones\Pages\ListTransacciones;
use App\Filament\Resources\Transacciones\Pages\ViewTransacciones;
use App\Filament\Resources\Transacciones\Schemas\TransaccionesForm;
use App\Filament\Resources\Transacciones\Schemas\TransaccionesInfolist;
use App\Filament\Resources\Transacciones\Tables\TransaccionesTable;
use App\Models\Transacciones;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransaccionesResource extends Resource
{
    protected static ?string $model = Transacciones::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'yes';

    public static function form(Schema $schema): Schema
    {
        return TransaccionesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TransaccionesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaccionesTable::configure($table)
            ->defaultSort('created_at', 'desc')
            ->persistSortInSession();
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
            'index' => ListTransacciones::route('/'),
            'create' => CreateTransacciones::route('/create'),
            'view' => ViewTransacciones::route('/{record}'),
            'edit' => EditTransacciones::route('/{record}/edit'),
        ];
    }
}
