<?php

namespace App\Presentation\Filament\Resources\Transacaos\Pages;

use App\Presentation\Filament\Resources\Transacaos\TransacaoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTransacao extends EditRecord
{
    protected static string $resource = TransacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
