<?php

namespace App\Presentation\Filament\Resources\Investimentos\Pages;

use App\Presentation\Filament\Resources\Investimentos\InvestimentoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageInvestimentos extends ManageRecords
{
    protected static string $resource = InvestimentoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
