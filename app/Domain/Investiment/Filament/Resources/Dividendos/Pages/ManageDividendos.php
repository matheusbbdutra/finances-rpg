<?php

namespace App\Domain\Investiment\Filament\Resources\Dividendos\Pages;

use App\Domain\Investiment\Filament\Resources\Dividendos\DividendoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDividendos extends ManageRecords
{
    protected static string $resource = DividendoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
