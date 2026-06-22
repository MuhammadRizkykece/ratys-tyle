<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ShopStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Produk',
                Product::count()
            )
                ->description('Produk tersedia')
                ->icon('heroicon-o-cube')
                ->color('primary'),

            Stat::make(
                'Total Order',
                Order::count()
            )
                ->description('Semua pesanan')
                ->icon('heroicon-o-shopping-cart')
                ->color('info'),


            Stat::make(
                'Pendapatan Bulan Ini',
                'Rp ' . number_format(
                    Order::where('status', 'completed')
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->sum('total'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description(now()->translatedFormat('F Y'))
                ->icon('heroicon-o-banknotes')
                ->color('success'),


            Stat::make(
                'Menunggu Pembayaran',
                Order::where('status', 'pending')
                    ->count()
            )
                ->description('Perlu dicek')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make(
                'Total User',
                User::count()
            )
                ->description('User terdaftar')
                ->icon('heroicon-o-users')
                ->color('primary'),

            Stat::make(
                'Total Revenue',
                'Rp ' . number_format(
                    Order::where('status', 'completed')
                        ->sum('total'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Semua pendapatan')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make(
                'Order Hari Ini',
                Order::whereDate(
                    'created_at',
                    today()
                )->count()
            )
                ->description('Pesanan masuk hari ini')
                ->icon('heroicon-o-calendar-days')
                ->color('info'),

        ];
    }
}
