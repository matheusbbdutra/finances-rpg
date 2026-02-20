<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id("admin")
            ->path("admin")
            ->login()
            ->colors([
                "primary" => Color::Violet,
                "secondary" => Color::Indigo,
                "success" => Color::Emerald,
                "danger" => Color::Rose,
                "warning" => Color::Amber,
                "info" => Color::Sky,
            ])
            ->discoverResources(
                in: app_path("Domain/Finance/Filament/Resources"),
                for: "App\Domain\Finance\Filament\Resources",
            )
            ->discoverResources(
                in: app_path("Domain/Gamification/Filament/Resources"),
                for: "App\Domain\Gamification\Filament\Resources",
            )
            ->discoverResources(
                in: app_path("Domain/Investiment/Filament/Resources"),
                for: "App\Domain\Investiment\Filament\Resources"
            )
            ->discoverPages(in: app_path("Domain/Finance/Filament/Pages"), for: "App\Domain\Finance\Filament\Pages")
            ->discoverPages(
                in: app_path("Domain/Gamification/Filament/Pages"),
                for: "App\Domain\Gamification\Filament\Pages",
            )
            ->discoverPages(
                in: app_path("Domain/Investiment/Filament/Pages"),
                for: "App\Domain\Investiment\Filament\Pages",
            )
            ->pages([Dashboard::class])
            ->discoverWidgets(
                in: app_path("Domain/Finance/Filament/Widgets"),
                for: "App\Domain\Finance\Filament\Widgets",
            )
            ->discoverWidgets(
                in: app_path("Domain/Gamification/Filament/Widgets"),
                for: "App\Domain\Gamification\Filament\Widgets",
            )
            ->widgets([AccountWidget::class])
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
            ->authMiddleware([Authenticate::class])
            ->navigationGroups([
                "Painel Principal",
                "Meu Dinheiro",
                "Investimentos",
                "Gamificação",
            ]);
    }
}