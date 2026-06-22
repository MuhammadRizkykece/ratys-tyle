<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('brand.name')
                    ->label('Brand'),

                TextColumn::make('category.name')
                    ->label('Category'),

                TextColumn::make('price')
                    ->money('IDR'),

                TextColumn::make('stock'),

                IconColumn::make('featured')
                    ->boolean(),

                IconColumn::make('status')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
