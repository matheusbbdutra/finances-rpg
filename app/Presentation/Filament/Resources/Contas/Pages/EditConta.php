<?php

namespace App\Presentation\Filament\Resources\Contas\Pages;

use App\Presentation\Filament\Resources\Contas\ContaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConta extends EditRecord
{
    protected static string $resource = ContaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
