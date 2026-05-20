<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),

                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'email' => 'El correo no tiene un formato válido.',
                        'required' => 'El correo es obligatorio.',
                        'unique' => 'Este correo ya está registrado.',
                    ]),

                Select::make('rol')
                    ->label('Rol')
                    ->options([
                        'admin' => 'Administrador',
                        'user' => 'Usuario',
                    ])
                    ->required(),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->placeholder(
                        fn (string $context): string =>
                            $context === 'edit'
                                ? 'Dejar en blanco para mantener actual'
                                : ''
                    )
                    ->maxLength(16)
                    ->rule(
                        Password::min(8)
                            ->letters()
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                    )
                    ->validationMessages([
                        'required' => 'La contraseña es obligatoria.',
                        'min' => 'La contraseña debe tener al menos 8 caracteres.',
                        'max' => 'La contraseña no puede tener más de 16 caracteres.',
                    ]),
            ]);
    }
}