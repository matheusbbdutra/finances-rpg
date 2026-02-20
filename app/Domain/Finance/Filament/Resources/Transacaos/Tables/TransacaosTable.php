<?php namespace App\Domain\Finance\Filament\Resources\Transacaos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransacaosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("data_transacao")->label("Data")->date("d/m/Y")->sortable()->searchable(),

                TextColumn::make("tipo")->label("Tipo")->badge()->color(
                    fn(string $state): string => match ($state) {
                        "receita" => "success",
                        "despesa" => "danger",
                        "transferencia" => "info",
                        "estorno" => "warning",
                        default => "gray",
                    },
                ),

                TextColumn::make("descricao")->label("Descrição")->searchable()->limit(50),

                TextColumn::make("categoria.nome")->label("Categoria")->searchable(),

                TextColumn::make("conta.nome")->label("Conta")->searchable(),

                TextColumn::make("cartao.nome")->label("Cartão")->searchable()->toggleable(),

                TextColumn::make("valor")->label("Valor")->money("BRL")->sortable()->alignEnd()->color(
                    fn($record): string => match ($record->tipo) {
                        "receita" => "success",
                        "despesa" => "danger",
                        default => "gray",
                    },
                ),

                TextColumn::make("parcelas")
                    ->label("Parcelas")
                    ->formatStateUsing(fn(int $state, $record): string => $state > 1 ? "{$state}x" : "À vista")
                    ->toggleable(),

                TextColumn::make("localizacao")->label("Local")->limit(30)->toggleable(),
            ])
            ->filters([])
            ->recordActions([ViewAction::make(), EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->defaultSort("data_transacao", "desc");
    }
}
