<?php

namespace App\Presentation\Filament\Resources\Transacaos;

use App\Domain\Finance\Models\Transacao;
use App\Presentation\Filament\Resources\Transacaos\Pages\ListTransacaos;
use App\Presentation\Filament\Resources\Transacaos\Schemas\TransacaoForm;
use App\Presentation\Filament\Resources\Transacaos\Schemas\TransacaoInfolist;
use App\Presentation\Filament\Resources\Transacaos\Tables\TransacaosTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransacaoResource extends Resource
{
    protected static ?string $model = Transacao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static ?string $recordTitleAttribute = "descricao";

    protected static ?string $navigationLabel = "Transações";

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }

    public static function form(Schema $schema): Schema
    {
        return TransacaoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TransacaoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransacaosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListTransacaos::route("/"),
        ];
    }
}
