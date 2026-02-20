<?php

namespace App\Domain\Finance\Filament\Resources\Transacaos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Schemas\Schema;

class TransacaoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make("Informações")->tabs([
                Tabs\Tab::make("Dados Principais")->schema([
                    TextEntry::make("tipo")->label("Tipo")->badge(),
                    TextEntry::make("descricao")->label("Descrição"),
                    TextEntry::make("valor")->label("Valor")->money("BRL"),
                    TextEntry::make("data_transacao")->label("Data")->date("d/m/Y"),
                    TextEntry::make("categoria.nome")->label("Categoria"),
                    TextEntry::make("conta.nome")->label("Conta"),
                    TextEntry::make("cartao.nome")->label("Cartão"),
                ]),
                Tabs\Tab::make("Detalhes")->schema([
                    TextEntry::make("parcelas")->label("Parcelas"),
                    TextEntry::make("localizacao")->label("Local"),
                    TextEntry::make("data_efetivacao")->label("Data Efetivação")->date("d/m/Y"),
                    TextEntry::make("observacoes")->label("Observações")->有限的(4),
                ]),
            ]),
        ]);
    }
}
