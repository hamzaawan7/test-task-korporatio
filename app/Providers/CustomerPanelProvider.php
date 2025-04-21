<?php

namespace App\Providers;

use Filament\Panel;
use Filament\PanelProvider;
use App\Models\User;
use Filament\Navigation\NavigationItem;

class CustomerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('customer')
            ->path('customer')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->authGuard('web')
            ->authPasswordBroker('users')
            ->userMenuItems([
                'profile' => NavigationItem::make()->url(fn (): string => route('filament.customer.pages.profile')),
            ])
            ->colors([
                'primary' => '#4f46e5',
            ])
            ->discoverResources(in: app_path('Filament/Customer/Resources'), for: 'App\\Filament\\Customer\\Resources')
            ->discoverPages(in: app_path('Filament/Customer/Pages'), for: 'App\\Filament\\Customer\\Pages')
            ->discoverWidgets(in: app_path('Filament/Customer/Widgets'), for: 'App\\Filament\\Customer\\Widgets')
            ->middleware([
                \App\Http\Middleware\RedirectIfNotCustomer::class,
            ])
            ->databaseNotifications();
    }
}
