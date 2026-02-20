<?php

namespace App\Domain\Finance\Filament\Resources\Parcelas\Pages;

use App\Domain\Finance\Filament\Resources\Parcelas\ParcelaResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ManageRecords;

class ManageParcelas extends ManageRecords
{
    protected static string $resource = ParcelaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Parcela')
                ->modalHeading('Criar Parcela')
                ->modalWidth('sm')
                ->modal(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            ViewAction::make()->modal()->modalWidth('sm'),
            EditAction::make()->modal()->modalWidth('sm'),
            DeleteAction::make(),
        ];
    }
}
