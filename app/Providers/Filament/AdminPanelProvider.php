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
                in: app_path("Presentation/Filament/Resources"),
                for: "App\Presentation\Filament\Resources",
            )
            ->discoverResources(
                in: app_path("Presentation/Filament/Resources"),
                for: "App\Presentation\Filament\Resources",
            )
            ->discoverResources(
                in: app_path("Presentation/Filament/Resources"),
                for: "App\Presentation\Filament\Resources"
            )
            ->discoverPages(in: app_path("Presentation/Filament/Pages"), for: "App\Presentation\Filament\Pages")
            ->discoverPages(
                in: app_path("Presentation/Filament/Pages"),
                for: "App\Presentation\Filament\Pages",
            )
            ->discoverPages(
                in: app_path("Presentation/Filament/Pages"),
                for: "App\Presentation\Filament\Pages",
            )
            ->pages([Dashboard::class])
            ->discoverWidgets(
                in: app_path("Presentation/Filament/Widgets"),
                for: "App\Presentation\Filament\Widgets",
            )
            ->discoverWidgets(
                in: app_path("Presentation/Filament/Widgets"),
                for: "App\Presentation\Filament\Widgets",
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
