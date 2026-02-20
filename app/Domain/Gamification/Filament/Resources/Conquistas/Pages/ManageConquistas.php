<?php 

namespace App\Domain\Gamification\Filament\Resources\Conquistas\Pages;

use App\Domain\Gamification\Filament\Resources\Conquistas\ConquistaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageConquistas extends ManageRecords
{
    protected static string $resource = ConquistaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
