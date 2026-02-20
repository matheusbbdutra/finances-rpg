<?php

namespace App\Domain\Finance\Filament\Resources\Transacaos\Schemas;

use App\Domain\Finance\Enums\TipoTransacao;
use App\Domain\Finance\Models\Conta;
use App\Domain\Finance\Models\Cartao;
use App\Domain\Finance\Models\Categoria;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransacaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Dados da Transação")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    Radio::make("tipo")
                        ->label("Tipo")
                        ->options(collect(TipoTransacao::cases())->map(fn($case) => $case->value)->all())
                        ->required()
                        ->inline()
                        ->live()
                        ->columnSpanFull(),

                    Select::make("conta_id")
                        ->label("Conta")
                        ->placeholder("Selecione uma conta")
                        ->options(
                            fn() => Conta::where("user_id", auth()->id())
                                ->where("ativo", true)
                                ->pluck("nome", "id"),
                        )
                        ->searchable()
                        ->required(),

                    Select::make("cartao_id")
                        ->label("Cartão")
                        ->placeholder("Selecione um cartão (opcional)")
                        ->options(
                            fn() => Cartao::where("user_id", auth()->id())
                                ->where("ativo", true)
                                ->pluck("nome", "id"),
                        )
                        ->searchable()
                        ->nullable(),

                    Select::make("categoria_id")
                        ->label("Categoria")
                        ->placeholder("Selecione uma categoria")
                        ->options(
                            fn() => Categoria::where("user_id", auth()->id())
                                ->where("ativo", true)
                                ->pluck("nome", "id"),
                        )
                        ->searchable()
                        ->required(),

                    TextInput::make("descricao")
                        ->label("Descrição")
                        ->placeholder("Ex: Compras no Supermercado")
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make("valor")
                        ->label("Valor")
                        ->prefix('R$')
                        ->numeric()
                        ->required()
                        ->placeholder("0,00"),

                    Textarea::make("observacoes")
                        ->label("Observações")
                        ->placeholder("Informações adicionais...")
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),
                ]),

            Section::make("Configurações")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    DatePicker::make("data_transacao")
                        ->label("Data da Transação")
                        ->required()
                        ->default(now()),

                    DatePicker::make("data_efetivacao")
                        ->label("Data de Efetivação"),

                    TextInput::make("parcelas")
                        ->label("Número de Parcelas")
                        ->numeric()
                        ->minValue(1)
                        ->default(1)
                        ->placeholder("1"),

                    TextInput::make("localizacao")
                        ->label("Local")
                        ->placeholder("Ex: Shopping Center")
                        ->maxLength(100),
                ]),
        ]);
    }
}
