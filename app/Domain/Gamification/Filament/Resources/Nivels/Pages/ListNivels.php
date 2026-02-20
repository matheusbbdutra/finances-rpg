<?php

namespace App\Domain\Gamification\Filament\Resources\Nivels\Pages;

use App\Domain\Gamification\Filament\Resources\Nivels\NivelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNivels extends ListRecords
{
    protected static string $resource = NivelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
