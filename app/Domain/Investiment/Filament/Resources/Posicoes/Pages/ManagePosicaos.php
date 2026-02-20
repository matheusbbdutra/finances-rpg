<?php

namespace App\Domain\Investiment\Filament\Resources\Posicoes\Pages;

use App\Domain\Investiment\Filament\Resources\Posicoes\PosicaoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePosicoes extends ManageRecords
{
    protected static string $resource = PosicaoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
