<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Order Selesai',
                Order::where('status', 'completed')->count()
            ),

            Stat::make(
                'Order Dibatalkan',
                Order::where('status', 'cancelled')->count()
            ),

            Stat::make(
                'Pendapatan Selesai',
                'Rp ' . number_format(
                    Order::where('status', 'completed')->sum('total'),
                    0,
                    ',',
                    '.'
                )
            ),

        ];
    }
}
