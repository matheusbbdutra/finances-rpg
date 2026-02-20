<?php

namespace App\Domain\Investiment\Filament\Resources\Dividendos;

use App\Domain\Investiment\Filament\Resources\Dividendos\Pages\ManageDividendos;
use App\Domain\Investiment\Models\Dividendo;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class DividendoResource extends Resource
{
    protected static ?string $model = Dividendo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static ?string $recordTitleAttribute = "id";

    protected static ?string $navigationLabel = "Dividendos";

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return "Investimentos";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make("ativo_id")->numeric(),
            TextInput::make("posicao_id")->numeric(),
            TextInput::make("tipo")->maxLength(50),
            TextInput::make("valor")->numeric(),
            TextInput::make("data_pagamento"),
            TextInput::make("data_com"),
            TextInput::make("quantidade")->numeric(),
            TextInput::make("preco_unitario")->numeric(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("id"),
            TextEntry::make("tipo"),
            TextEntry::make("valor"),
            TextEntry::make("data_pagamento"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("id")
            ->columns([
            TextColumn::make("id")->label("ID"),
            TextColumn::make("tipo")->searchable(),
            TextColumn::make("valor")->money("BRL"),
            TextColumn::make("data_pagamento")->date("d/m/Y"),
            TextColumn::make("data_com")->date("d/m/Y"),
            ])->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])->toolbarActions(
                [BulkActionGroup::make([DeleteBulkAction::make()])
            ]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManageDividendos::route("/"),
        ];
    }

}
