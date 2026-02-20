<?php

namespace App\Presentation\Filament\Resources\Transacaos\Pages;

use App\Presentation\Filament\Resources\Transacaos\TransacaoResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ListRecords;

class ListTransacaos extends ListRecords
{
    protected static string $resource = TransacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Transação')
                ->modalHeading('Criar Transação')
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
