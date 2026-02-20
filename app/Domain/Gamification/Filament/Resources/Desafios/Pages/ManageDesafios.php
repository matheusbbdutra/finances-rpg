<?php

namespace App\Domain\Gamification\Filament\Resources\Desafios\Pages;

use App\Domain\Gamification\Filament\Resources\Desafios\DesafioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDesafios extends ManageRecords
{
    protected static string $resource = DesafioResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
