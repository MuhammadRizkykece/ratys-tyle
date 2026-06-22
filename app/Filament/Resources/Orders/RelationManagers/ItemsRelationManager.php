<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('product.name')
                    ->label('Product'),

                TextColumn::make('size')
                    ->label('Size'),

                TextColumn::make('color')
                    ->label('Color'),

                TextColumn::make('quantity')
                    ->label('Qty'),

                TextColumn::make('price')
                    ->money('IDR'),
            ]);
    }
}
