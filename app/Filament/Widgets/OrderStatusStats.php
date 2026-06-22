<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatusStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending', Order::where('status', 'pending')->count())
                ->color('warning'),

            Stat::make('Processing', Order::where('status', 'processing')->count())
                ->color('info'),

            Stat::make('Shipped', Order::where('status', 'shipped')->count())
                ->color('primary'),

            Stat::make('Completed', Order::where('status', 'completed')->count())
                ->color('success'),

            Stat::make('Cancelled', Order::where('status', 'cancelled')->count())
                ->color('danger'),
        ];
    }
}
