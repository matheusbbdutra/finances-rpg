<?php

namespace App\Presentation\Filament\Resources\Conquistas;

use App\Domain\Gamification\Models\Conquista;
use App\Presentation\Filament\Resources\Conquistas\Pages\ManageConquistas;
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

class ConquistaResource extends Resource
{
    protected static ?string $model = Conquista::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;

    protected static ?string $recordTitleAttribute = "nome";

    protected static ?string $navigationLabel = "Conquistas";

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return "Gamificação";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make("nome")->required()->maxLength(100),
            TextInput::make("descricao")->maxLength(255),
            TextInput::make("tipo")->maxLength(50),
            TextInput::make("meta")->numeric(),
            TextInput::make("recompensa_xp")->numeric(),
            TextInput::make("recompensa_moeda")->numeric(),
            TextInput::make("icone")->maxLength(50),
            TextInput::make("cor")->maxLength(7),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("nome"),
            TextEntry::make("descricao"),
            TextEntry::make("recompensa_xp"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("nome")
            ->columns([
                TextColumn::make("nome")->searchable(),
                TextColumn::make("tipo")->searchable(),
                TextColumn::make("recompensa_xp")->label("XP"),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManageConquistas::route("/"),
        ];
    }
}
