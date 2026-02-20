<?php

namespace App\Presentation\Filament\Resources\Posicoes;

use App\Domain\Investiment\Models\Posicao;
use App\Presentation\Filament\Resources\Posicoes\Pages\ManagePosicoes;
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

class PosicaoResource extends Resource
{
    protected static ?string $model = Posicao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCircleStack;

    protected static ?string $recordTitleAttribute = "id";

    protected static ?string $navigationLabel = "Posições";

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return "Investimentos";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make("user_id")->numeric(),
            TextInput::make("investimento_id")->numeric(),
            TextInput::make("ativo_id")->numeric(),
            TextInput::make("quantidade")->numeric(),
            TextInput::make("preco_medio")->numeric(),
            TextInput::make("valor_atual")->numeric(),
            TextInput::make("variacao")->numeric(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("id"),
            TextEntry::make("quantidade"),
            TextEntry::make("valor_atual"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("id")
            ->columns([
                TextColumn::make("id")->label("ID"),
                TextColumn::make("ativo.codigo")->label("Ativo"),
                TextColumn::make("quantidade")->label("Qtd"),
                TextColumn::make("preco_medio")->money("BRL"),
                TextColumn::make("valor_atual")->money("BRL"),
                TextColumn::make("variacao")->suffix("%"),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManagePosicoes::route("/"),
        ];
    }
}
