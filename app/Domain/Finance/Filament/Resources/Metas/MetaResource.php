<?php

namespace App\Domain\Finance\Filament\Resources\Metas;

use App\Domain\Finance\Filament\Resources\Metas\Pages\ManageMetas;
use App\Domain\Finance\Models\Meta;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MetaResource extends Resource
{
    protected static ?string $model = Meta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    protected static ?string $recordTitleAttribute = "nome";

    protected static ?string $navigationLabel = "Metas";

    protected static ?int $navigationSort = 7;

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Dados da Meta")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    TextInput::make("nome")
                        ->label("Nome")
                        ->required()
                        ->maxLength(100)
                        ->columnSpanFull(),

                    Textarea::make("descricao")
                        ->label("Descrição")
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make("valor_alvo")
                        ->label("Valor Alvo")
                        ->prefix('R$')
                        ->required()
                        ->numeric(),

                    TextInput::make("valor_atual")
                        ->label("Valor Atual")
                        ->prefix('R$')
                        ->numeric()
                        ->default(0),

                    DatePicker::make("data_inicio")
                        ->label("Data de Início"),

                    DatePicker::make("data_meta")
                        ->label("Data da Meta")
                        ->required(),

                    Select::make("status")
                        ->label("Status")
                        ->options([
                            'ativa' => 'Ativa',
                            'concluida' => 'Concluída',
                            'cancelada' => 'Cancelada',
                        ])
                        ->default('ativa'),

                    Toggle::make("ativo")->label("Ativo")->default(true)->columnSpanFull(),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("nome"),
            TextEntry::make("valor_alvo"),
            TextEntry::make("valor_atual"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("nome")
            ->columns([
                TextColumn::make("nome")->searchable(),
                TextColumn::make("valor_alvo")->money("BRL"),
                TextColumn::make("valor_atual")->money("BRL"),
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
            "index" => ManageMetas::route("/"),
        ];
    }
}
