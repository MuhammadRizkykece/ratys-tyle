<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('discount_percent')
                    ->required()
                    ->numeric(),
                TextInput::make('minimum_purchase')
                    ->numeric()
                    ->required()
                    ->default(0),
                DatePicker::make('expired_at'),
                Toggle::make('status')
                    ->default(true),
            ]);
    }
}
