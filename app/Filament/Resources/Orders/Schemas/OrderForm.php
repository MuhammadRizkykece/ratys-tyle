<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),

                TextInput::make('name')
                    ->required(),

                TextInput::make('phone')
                    ->tel()
                    ->required(),

                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('total')
                    ->required()
                    ->numeric(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),

                TextInput::make('tracking_number')
                    ->label('Nomor Resi')
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (! empty($state)) {
                            $set('status', 'shipped');
                        }
                    }),
            ]);
    }
}
