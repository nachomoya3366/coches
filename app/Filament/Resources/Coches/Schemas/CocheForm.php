<?php

namespace App\Filament\Resources\Coches\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class CocheForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('imagen')
                    ->image()
                    ->directory('img')
                    ->disk('public')
                    ->imagePreviewHeight('120')
                    ->label('Imagen del coche'),
                TextInput::make('matricula')
                    ->unique('coches', 'matricula')
                    ->required(),
                Select::make('marca')
                    ->label('Marca del coche')
                    ->searchable()
                    ->allowHtml()
                    ->options([
                        'Toyota' => '<div class="flex items-center justify-between"><span>Toyota</span><img src="/storage/img/marcas/toyota.png" width="32" height="32" class="object-contain" /></div>',
                        'Volkswagen' => '<div class="flex items-center justify-between"><span>Volkswagen</span><img src="/storage/img/marcas/volkswagen.png" width="32" height="32" class="object-contain" /></div>',
                        'Ford' => '<div class="flex items-center justify-between"><span>Ford</span><img src="/storage/img/marcas/ford.png" width="32" height="32" class="object-contain" /></div>',
                        'BMW' => '<div class="flex items-center justify-between"><span>BMW</span><img src="/storage/img/marcas/bmw.png" width="32" height="32" class="object-contain" /></div>',
                        'Mercedes' => '<div class="flex items-center justify-between"><span>Mercedes-Benz</span><img src="/storage/img/marcas/mercedes.png" width="32" height="32" class="object-contain" /></div>',
                        'Audi' => '<div class="flex items-center justify-between"><span>Audi</span><img src="/storage/img/marcas/audi.png" width="32" height="32" class="object-contain" /></div>',
                        'Honda' => '<div class="flex items-center justify-between"><span>Honda</span><img src="/storage/img/marcas/honda.png" width="32" height="32" class="object-contain" /></div>',
                        'Nissan' => '<div class="flex items-center justify-between"><span>Nissan</span><img src="/storage/img/marcas/nissan.png" width="32" height="32" class="object-contain" /></div>',
                        'Hyundai' => '<div class="flex items-center justify-between"><span>Hyundai</span><img src="/storage/img/marcas/hyundai.png" width="32" height="32" class="object-contain" /></div>',
                        'Kia' => '<div class="flex items-center justify-between"><span>Kia</span><img src="/storage/img/marcas/kia.png" width="32" height="32" class="object-contain" /></div>',
                        'Renault' => '<div class="flex items-center justify-between"><span>Renault</span><img src="/storage/img/marcas/renault.png" width="32" height="32" class="object-contain" /></div>',
                        'Peugeot' => '<div class="flex items-center justify-between"><span>Peugeot</span><img src="/storage/img/marcas/peugeot.png" width="32" height="32" class="object-contain" /></div>',
                        'Fiat' => '<div class="flex items-center justify-between"><span>Fiat</span><img src="/storage/img/marcas/fiat.png" width="32" height="32" class="object-contain" /></div>',
                        'Lamborghini' => '<div class="flex items-center justify-between"><span>Lamborghini</span><img src="/storage/img/marcas/lamborghini.png" width="32" height="32" class="object-contain" /></div>',
                        'Volvo' => '<div class="flex items-center justify-between"><span>Volvo</span><img src="/storage/img/marcas/volvo.png" width="32" height="32" class="object-contain" /></div>',
                        'Mazda' => '<div class="flex items-center justify-between"><span>Mazda</span><img src="/storage/img/marcas/mazda.png" width="32" height="32" class="object-contain" /></div>',
                        'Porsche' => '<div class="flex items-center justify-between"><span>Porsche</span><img src="/storage/img/marcas/porsche.png" width="32" height="32" class="object-contain" /></div>',
                        'Ferrari' => '<div class="flex items-center justify-between"><span>Ferrari</span><img src="/storage/img/marcas/ferrari.png" width="32" height="32" class="object-contain" /></div>',
                        'Jeep' => '<div class="flex items-center justify-between"><span>Jeep</span><img src="/storage/img/marcas/jeep.png" width="32" height="32" class="object-contain" /></div>',
                        'Skoda' => '<div class="flex items-center justify-between"><span>Skoda</span><img src="/storage/img/marcas/skoda.png" width="32" height="32" class="object-contain" /></div>',
                        'Seat' => '<div class="flex items-center justify-between"><span>Seat</span><img src="/storage/img/marcas/seat.png" width="32" height="32" class="object-contain" /></div>',
                        'Alfa Romeo' => '<div class="flex items-center justify-between"><span>Alfa Romeo</span><img src="/storage/img/marcas/alfaromeo.png" width="32" height="32" class="object-contain" /></div>',
                        'Mini' => '<div class="flex items-center justify-between"><span>Mini</span><img src="/storage/img/marcas/mini.png" width="32" height="32" class="object-contain" /></div>',
                        'Land Rover' => '<div class="flex items-center justify-between"><span>Land Rover</span><img src="/storage/img/marcas/landrover.png" width="32" height="32" class="object-contain" /></div>',
                        'Subaru' => '<div class="flex items-center justify-between"><span>Subaru</span><img src="/storage/img/marcas/subaru.png" width="32" height="32" class="object-contain" /></div>',
                        'Opel' => '<div class="flex items-center justify-between"><span>Opel</span><img src="/storage/img/marcas/opel.png" width="32" height="32" class="object-contain" /></div>',
                        'Citroen' => '<div class="flex items-center justify-between"><span>Citroen</span><img src="/storage/img/marcas/citroen.png" width="32" height="32" class="object-contain" /></div>',
                    ])
                    ->required(),
                TextInput::make('modelo')
                    ->required(),
                TextInput::make('color')
                    ->required(),
                TextInput::make('año')
                    ->required()
                    ->numeric(),
                TextInput::make('kilometros')
                    ->required()
                    ->numeric(),
                Select::make('combustible')
                    ->options([
                        'diesel' => 'Diésel',
                        'gasolina' => 'Gasolina',
                    ])
                    ->required(),
                Select::make('proveedore_id')
                    ->relationship('proveedor', 'nombre')
                    ->preload()
                    ->required(),
                TextInput::make('precio_compra')
                    ->required()
                    ->numeric(),    
            ]);
    }
}
