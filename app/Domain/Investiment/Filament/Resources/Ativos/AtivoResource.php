<?php

namespace App\Domain\Investiment\Filament\Resources\Ativos;

use App\Domain\Investiment\Filament\Resources\Ativos\Pages\ManageAtivos;
use App\Domain\Investiment\Models\Ativo;
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

class AtivoResource extends Resource
{
    protected static ?string $model = Ativo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $recordTitleAttribute = "codigo";

    protected static ?string $navigationLabel = "Ativos";

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return "Investimentos";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make("codigo")->required()->maxLength(10),
            TextInput::make("nome")->required()->maxLength(200),
            TextInput::make("tipo")->maxLength(20),
            TextInput::make("preco_atual")->numeric(),
            TextInput::make("variacao_dia")->numeric(),
            TextInput::make("dividend_yield")->numeric(),
            TextInput::make("p_l")->numeric(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("codigo"),
            TextEntry::make("nome"),
            TextEntry::make("tipo"),
            TextEntry::make("preco_atual"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("codigo")
            ->columns([
                TextColumn::make("codigo")->searchable(),
                TextColumn::make("nome")->searchable(),
                TextColumn::make("tipo")->searchable(),
                TextColumn::make("preco_atual")->money("BRL"),
                TextColumn::make("variacao_dia")->suffix("%"),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManageAtivos::route("/"),
        ];
    }
}
