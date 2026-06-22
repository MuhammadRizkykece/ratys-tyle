<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class TopProducts extends TableWidget
{
    protected static ?string $heading = 'Produk Terlaris';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderItem::query()
                    ->selectRaw('MIN(id) as id, product_id, SUM(quantity) as total_sold')
                    ->groupBy('product_id')
                    ->orderByDesc('total_sold')
            )
            ->columns([
                TextColumn::make('product.name')
                    ->label('Produk'),

                TextColumn::make('total_sold')
                    ->label('Terjual'),
            ]);
    }
}
