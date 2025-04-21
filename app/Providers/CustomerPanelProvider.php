<?php

namespace App\Providers;

use App\Http\Middleware\RedirectIfNotCustomer;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CustomerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('customer')
            ->path('customer')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->userMenuItems([
                'Profile' => MenuItem::make()->label('Profile'),
            ])
            ->discoverResources(
                in: app_path('Filament/Customer/Resources'),
                for: 'App\\Filament\\Customer\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Customer/Pages'),
                for: 'App\\Filament\\Customer\\Pages'
            )
            ->discoverWidgets(
                in: app_path('Filament/Customer/Widgets'),
                for: 'App\\Filament\\Customer\\Widgets'
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                RedirectIfNotCustomer::class,
            ]);
    }
}
