<?php

namespace App\Presentation\Filament\Resources\Cartaos\Pages;

use App\Presentation\Filament\Resources\Cartaos\CartaoResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCartao extends ManageRecords
{
    protected static string $resource = CartaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Cartão')
                ->modalHeading('Criar Cartão')
                ->modalWidth('md')
                ->modal()
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
