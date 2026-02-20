<?php

namespace App\Domain\Finance\Filament\Resources\Categorias\Pages;

use App\Domain\Finance\Filament\Resources\Categorias\CategoriaResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCategorias extends ManageRecords
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Categoria')
                ->modalHeading('Criar Categoria')
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
