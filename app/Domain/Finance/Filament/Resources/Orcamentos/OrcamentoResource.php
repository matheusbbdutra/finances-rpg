<?php

namespace App\Domain\Finance\Filament\Resources\Orcamentos;

use App\Domain\Finance\Filament\Resources\Orcamentos\Pages\ManageOrcamentos;
use App\Domain\Finance\Models\Categoria;
use App\Domain\Finance\Models\Orcamento;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrcamentoResource extends Resource
{
    protected static ?string $model = Orcamento::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartPie;

    protected static ?string $recordTitleAttribute = "nome";

    protected static ?string $navigationLabel = "Orçamentos";

    protected static ?int $navigationSort = 6;

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Dados do Orçamento")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    TextInput::make("nome")
                        ->label("Nome")
                        ->required()
                        ->maxLength(100)
                        ->columnSpanFull(),

                    Select::make("categoria_id")
                        ->label("Categoria")
                        ->options(
                            fn() => Categoria::where('user_id', auth()->id())
                                ->where('ativo', true)
                                ->pluck('nome', 'id'),
                        )
                        ->searchable()
                        ->required(),

                    TextInput::make("valor_limite")
                        ->label("Valor Limite")
                        ->prefix('R$')
                        ->required()
                        ->numeric(),

                    TextInput::make("valor_gasto")
                        ->label("Valor Gasto")
                        ->prefix('R$')
                        ->numeric()
                        ->default(0),

                    Select::make("ano")
                        ->label("Ano")
                        ->options(fn() => collect(range(now()->year, now()->year + 5))->mapWithKeys(fn($y) => [$y => $y])),

                    Select::make("mes")
                        ->label("Mês")
                        ->options([
                            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março',
                            4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
                            7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro',
                            10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro',
                        ]),

                    Toggle::make("ativo")->label("Ativo")->default(true)->columnSpanFull(),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("nome"),
            TextEntry::make("valor_limite"),
            TextEntry::make("valor_gasto"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("nome")
            ->columns([
                TextColumn::make("nome")->searchable(),
                TextColumn::make("valor_limite")->money("BRL"),
                TextColumn::make("valor_gasto")->money("BRL"),
                TextColumn::make("ano"),
                TextColumn::make("mes"),
            ])
            ->recordActions([
                ViewAction::make()->modal(),
                EditAction::make()->modal(),
                DeleteAction::make(),
            ])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            "index" => ManageOrcamentos::route("/"),
        ];
    }
}
