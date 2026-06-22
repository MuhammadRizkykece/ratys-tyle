<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestReviews extends TableWidget
{
    protected static ?string $heading = 'Review Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder =>
                Review::query()
                    ->with(['user', 'product'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer'),

                TextColumn::make('product.name')
                    ->label('Produk'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('comment')
                    ->label('Review')
                    ->limit(40),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y'),
            ]);
    }
}
