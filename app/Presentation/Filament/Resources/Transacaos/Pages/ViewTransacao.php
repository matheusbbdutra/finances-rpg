<?php

namespace App\Presentation\Filament\Resources\Transacaos\Pages;

use App\Presentation\Filament\Resources\Transacaos\TransacaoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTransacao extends ViewRecord
{
    protected static string $resource = TransacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
