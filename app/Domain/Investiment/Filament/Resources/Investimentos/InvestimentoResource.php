<?php

namespace App\Domain\Investiment\Filament\Resources\Investimentos;

use App\Domain\Investiment\Filament\Resources\Investimentos\Pages\ManageInvestimentos;
use App\Domain\Investiment\Models\Investimento;
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

class InvestimentoResource extends Resource
{
    protected static ?string $model = Investimento::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $recordTitleAttribute = "nome";

    protected static ?string $navigationLabel = "Investimentos";

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return "Investimentos";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make("nome")->required()->maxLength(100),
            TextInput::make("tipo")->maxLength(20),
            TextInput::make("conta_id")->numeric(),
            TextInput::make("valor_investido")->numeric(),
            TextInput::make("valor_atual")->numeric(),
            TextInput::make("taxa_retorno")->numeric(),
            TextInput::make("data_inicio"),
            TextInput::make("data_vencimento"),
            TextInput::make("liquidez")->maxLength(20),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("nome"),
            TextEntry::make("tipo"),
            TextEntry::make("valor_investido"),
            TextEntry::make("valor_atual"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("nome")
            ->columns([
                TextColumn::make("nome")->searchable(),
                TextColumn::make("tipo")->searchable(),
                TextColumn::make("valor_investido")->money("BRL"),
                TextColumn::make("valor_atual")->money("BRL"),
                TextColumn::make("taxa_retorno")->suffix("%"),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManageInvestimentos::route("/"),
        ];
    }
}
