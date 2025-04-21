<?php

namespace App\Filament\Customer\Pages;

use App\Filament\Customer\Widgets\OrderStats;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $routePath = 'dashboard';

    public function getTitle(): string
    {
        return 'Customer Dashboard';
    }
}
