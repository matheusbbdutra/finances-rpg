<?php

namespace App\Presentation\Filament\Resources\Categorias;

use App\Domain\Finance\Models\Categoria;
use App\Presentation\Filament\Resources\Categorias\Pages\ManageCategorias;
use BackedEnum;
use FawazIwalewa\FilamentIconPicker\Forms\Components\IconPicker;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = "nome";

    protected static ?string $navigationLabel = "Categorias";

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(1)
                ->schema([
                    Section::make("Dados da Categoria")->schema([
                        TextInput::make("nome")
                            ->label("Nome")
                            ->required()
                            ->maxLength(50),

                        Select::make("natureza")
                            ->label("Natureza")
                            ->placeholder("Selecione uma Natureza")
                            ->options([
                                "receita" => "Receita",
                                "despesa" => "Despesa",
                            ])
                            ->required(),

                        Select::make("categoria_pai_id")
                            ->label("Categoria Pai")
                            ->placeholder("Nenhuma (categoria principal)")
                            ->options(
                                fn() => Categoria::where("user_id", auth()->id())
                                    ->whereNull("categoria_pai_id")
                                    ->pluck("nome", "id"),
                            )
                            ->searchable()
                            ->nullable(),

                        ColorPicker::make("cor")->label("Cor")->hexColor(),

                        IconPicker::make("icone")->label("Ícone")->required(),

                        Toggle::make("ativo")->label("Ativo")->default(true),
                    ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([TextEntry::make("nome")]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("nome")
            ->columns([TextColumn::make("nome")->searchable(), TextColumn::make("natureza")->badge()])
            ->recordActions([ViewAction::make()->modal(), EditAction::make()->modal(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManageCategorias::route("/"),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
