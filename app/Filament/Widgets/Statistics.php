<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class Statistics extends ChartWidget
{
    protected static ?string $heading = 'Orders by Status';

    protected function getData(): array
    {
        // 1) Query counts grouped by status
        $counts = Order::
            groupBy('status')
            ->selectRaw('status, COUNT(*) as total')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'labels'   => array_keys($counts),
            'datasets' => [
                [
                    'label'           => 'Orders',
                    'data'            => array_values($counts),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
