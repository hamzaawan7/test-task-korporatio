<?php

namespace App\Filament\Customer\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::where('user_id', auth()->id())->count()),
            Stat::make('Pending Orders', Order::where('user_id', auth()->id())->where('status', 'pending')->count()),
            Stat::make('Completed Orders', Order::where('user_id', auth()->id())->where('status', 'completed')->count()),
        ];
    }
}
