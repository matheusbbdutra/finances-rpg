<?php

namespace App\Presentation\Filament\Resources\Contas\Schemas;

use App\Domain\Finance\Enums\TipoConta;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Detalhes da Conta")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    TextInput::make("nome")
                        ->label("Nome da Conta")
                        ->placeholder("Ex: Nubank Principal")
                        ->required()
                        ->maxLength(100)
                        ->columnSpanFull(),

                    Select::make("tipo")
                        ->label("Tipo")
                        ->options(collect(TipoConta::cases())->map(fn($case) => $case->value)->all())
                        ->required(),

                    TextInput::make("instituicao")
                        ->label("Instituição Financeira")
                        ->placeholder("Ex: Nu Pagamentos S.A.")
                        ->maxLength(100),
                ]),

            Section::make("Configuração")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    TextInput::make("saldo_inicial")
                        ->label("Saldo Inicial")
                        ->prefix('R$')
                        ->numeric()
                        ->default(0),

                    ColorPicker::make("cor")->label("Cor do Banco")->hexColor(),

                    TextInput::make("icone")
                        ->label("Ícone")
                        ->placeholder("bank, wallet, piggy-bank...")
                        ->maxLength(50),

                    Toggle::make("ativo")->label("Conta Ativa")->default(true)->columnSpanFull(),
                ]),
        ]);
    }
}
