<?php

namespace App\Domain\Finance\Filament\Resources\Transacaos\Pages;

use App\Domain\Finance\Filament\Resources\Transacaos\TransacaoResource;
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
