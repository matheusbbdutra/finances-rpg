<?php

namespace App\Domain\Finance\Filament\Resources\Contas;

use App\Domain\Finance\Models\Conta;
use App\Domain\Finance\Filament\Resources\Contas\Pages\ListContas;
use App\Domain\Finance\Filament\Resources\Contas\Schemas\ContaForm;
use App\Domain\Finance\Filament\Resources\Contas\Tables\ContasTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContaResource extends Resource
{
    protected static ?string $model = Conta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static ?string $recordTitleAttribute = "nome";

    protected static ?string $navigationLabel = "Contas";

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ContaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListContas::route("/"),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }
}
