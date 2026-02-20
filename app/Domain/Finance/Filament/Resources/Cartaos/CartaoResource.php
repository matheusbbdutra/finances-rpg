<?php

namespace App\Domain\Finance\Filament\Resources\Cartaos;

use App\Domain\Finance\Filament\Resources\Cartaos\Pages\ManageCartao;
use App\Domain\Finance\Models\Cartao;
use App\Domain\Finance\Models\Conta;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartaoResource extends Resource
{
    protected static ?string $model = Cartao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = "nome";

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(1)->schema([
                Section::make("Detalhes do Cartão")->schema([
                    TextInput::make("nome")
                        ->label("Nome do Cartão")
                        ->placeholder("Ex: Nubank Gold")
                        ->required()
                        ->maxLength(100),
    
                    Select::make("bandeira")
                        ->label("Bandeira")
                        ->options([
                            "visa" => "Visa",
                            "mastercard" => "Mastercard",
                            "amex" => "American Express",
                            "elo" => "Elo",
                            "hipercard" => "Hipercard",
                            "outro" => "Outro",
                        ])
                        ->required(),
    
                    Select::make("conta_vinculada_id")
                        ->label("Conta Vinculada")
                        ->placeholder("Selecione uma conta")
                        ->options(
                            fn() => Conta::where("user_id", auth()->id())
                                ->where("ativo", true)
                                ->pluck("nome", "id"),
                        )
                        ->searchable(),
                ]),
    
                Section::make("Limites e Datas")
                    ->schema([
                        TextInput::make("limite_total")->label("Limite Total")->prefix('R$')->numeric()->default(0),
    
                        TextInput::make("limite_utilizado")->label("Limite Utilizado")->prefix('R$')->numeric()->default(0),
    
                        TextInput::make("dia_fechamento")
                            ->label("Dia do Fechamento")
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(31)
                            ->placeholder("Ex: 15"),
    
                        TextInput::make("dia_vencimento")
                            ->label("Dia do Vencimento")
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(31)
                            ->placeholder("Ex: 20"),
    
                        Toggle::make("ativo")->label("Cartão Ativo")->default(true)->columnSpanFull(),
                    ]),
            ])->columnSpanFull()
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("nome")->label("Nome do Cartão"),
            TextEntry::make("bandeira")->label("Bandeira"),
            TextEntry::make("contaVinculada.nome")->label("Conta Vinculada"),
            TextEntry::make("limite_total")->label("Limite Total")->money("BRL"),
            TextEntry::make("limite_utilizado")->label("Limite Utilizado")->money("BRL"),
            TextEntry::make("dia_fechamento")->label("Dia do Fechamento"),
            TextEntry::make("dia_vencimento")->label("Dia do Vencimento"),
            IconEntry::make("ativo")->boolean()->label("Ativo"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("nome")->label("Nome")->searchable()->sortable(),

                TextColumn::make("bandeira")->label("Bandeira")->searchable()->badge()->color(
                    fn(string $state): string => match (strtolower($state)) {
                        "visa" => "blue",
                        "mastercard" => "orange",
                        "amex" => "green",
                        "elo" => "purple",
                        default => "gray",
                    },
                ),

                TextColumn::make("limite_total")->label("Limite Total")->money("BRL")->sortable(),

                TextColumn::make("limite_utilizado")->label("Utilizado")->money("BRL")->sortable(),

                TextColumn::make("dia_fechamento")
                    ->label("Fechamento")
                    ->formatStateUsing(fn(int $state): string => "Dia {$state}"),

                TextColumn::make("dia_vencimento")
                    ->label("Vencimento")
                    ->formatStateUsing(fn(int $state): string => "Dia {$state}"),

                TextColumn::make("contaVinculada.nome")->label("Conta Vinculada")->searchable(),

                IconColumn::make("ativo")->label("Ativo")->boolean()->sortable(),
            ])
            ->filters([])
            ->recordActions([ViewAction::make(), EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
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
            "index" => ManageCartao::route("/"),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
