<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LowStockProducts extends TableWidget
{
    protected static ?string $heading = 'Stok Menipis';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder =>
                Product::query()
                    ->where('stock', '<=', 5)
                    ->orderBy('stock')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Produk')
                    ->searchable(),

                TextColumn::make('stock')
                    ->label('Stok')
                    ->badge()
                    ->color('danger'),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),
            ]);
    }
}
