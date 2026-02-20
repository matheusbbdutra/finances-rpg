<?php

namespace App\Presentation\Filament\Resources\Contas\Pages;

use App\Presentation\Filament\Resources\Contas\ContaResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ListRecords;

class ListContas extends ListRecords
{
    protected static string $resource = ContaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Conta')
                ->modalHeading('Criar Conta')
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
