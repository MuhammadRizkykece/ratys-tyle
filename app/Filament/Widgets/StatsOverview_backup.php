<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Produk',
                Product::count()
            ),

            Stat::make(
                'Total Order',
                Order::count()
            ),

            Stat::make(
                'Order Pending',
                Order::where('status', 'pending')->count()
            ),

            Stat::make(
                'Total Pendapatan',
                'Rp ' . number_format(
                    Order::whereIn('status', [
                        'processing',
                        'shipped',
                        'completed',
                    ])->sum('total'),
                    0,
                    ',',
                    '.'
                )
            ),

        ];
    }
}
