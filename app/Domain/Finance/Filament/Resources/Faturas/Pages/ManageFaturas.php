<?php

namespace App\Domain\Finance\Filament\Resources\Faturas\Pages;

use App\Domain\Finance\Filament\Resources\Faturas\FaturaResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ManageRecords;

class ManageFaturas extends ManageRecords
{
    protected static string $resource = FaturaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Fatura')
                ->modalHeading('Criar Fatura')
                ->modalWidth('md')
                ->modal(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            ViewAction::make()->modal()->modalWidth('md'),
            EditAction::make()->modal()->modalWidth('md'),
            DeleteAction::make(),
        ];
    }
}
