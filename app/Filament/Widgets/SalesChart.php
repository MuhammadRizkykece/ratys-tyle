<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected ?string $heading = 'Penjualan per Bulan';

    public ?string $filter = null;

    protected function getFilters(): ?array
    {
        return [
            now()->year => now()->year,
            now()->year - 1 => now()->year - 1,
            now()->year - 2 => now()->year - 2,
            now()->year - 3 => now()->year - 3,
        ];
    }


    protected function getData(): array
    {
        $year = $this->filter ?? now()->year;

        $data = [];

        for ($month = 1; $month <= 12; $month++) {

            $data[] = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->sum('total');
        }


        return [
            'datasets' => [
                [
                    'label' => 'Omzet',
                    'data' => $data,
                ],
            ],

            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des',
            ],
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
