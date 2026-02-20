<?php

namespace App\Domain\Finance\Filament\Resources\Faturas;

use App\Domain\Finance\Filament\Resources\Faturas\Pages\ManageFaturas;
use App\Domain\Finance\Models\Cartao;
use App\Domain\Finance\Models\Fatura;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FaturaResource extends Resource
{
    protected static ?string $model = Fatura::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static ?string $recordTitleAttribute = "mes_referencia";

    protected static ?string $navigationLabel = "Faturas";

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Dados da Fatura")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    Select::make("cartao_id")
                        ->label("Cartão")
                        ->options(
                            fn() => Cartao::where('user_id', auth()->id())
                                ->where('ativo', true)
                                ->pluck('nome', 'id'),
                        )
                        ->searchable()
                        ->required(),

                    TextInput::make("mes_referencia")
                        ->label("Mês de Referência")
                        ->placeholder("Ex: 2024-01")
                        ->required()
                        ->maxLength(7)
                        ->columnSpanFull(),

                    TextInput::make("valor_fechamento")
                        ->label("Valor do Fechamento")
                        ->prefix('R$')
                        ->required()
                        ->numeric(),

                    TextInput::make("valor_vencimento")
                        ->label("Valor do Vencimento")
                        ->prefix('R$')
                        ->required()
                        ->numeric(),

                    TextInput::make("valor_pago")
                        ->label("Valor Pago")
                        ->prefix('R$')
                        ->numeric()
                        ->default(0),

                    DatePicker::make("data_fechamento")
                        ->label("Data do Fechamento"),

                    DatePicker::make("data_vencimento")
                        ->label("Data do Vencimento"),

                    DatePicker::make("data_pagamento")
                        ->label("Data do Pagamento"),

                    Select::make("status")
                        ->label("Status")
                        ->options([
                            'aberta' => 'Aberta',
                            'paga' => 'Paga',
                            'atrasada' => 'Atrasada',
                        ])
                        ->default('aberta'),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("mes_referencia"),
            TextEntry::make("valor_fechamento"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("mes_referencia")
            ->columns([
                TextColumn::make("mes_referencia")->label("Mês"),
                TextColumn::make("valor_fechamento")->label("Valor")->money("BRL"),
                TextColumn::make("status")->badge(),
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
            "index" => ManageFaturas::route("/"),
        ];
    }
}
