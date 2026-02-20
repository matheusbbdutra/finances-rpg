<?php

namespace App\Presentation\Filament\Resources\Ativos\Pages;

use App\Presentation\Filament\Resources\Ativos\AtivoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAtivos extends ManageRecords
{
    protected static string $resource = AtivoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
