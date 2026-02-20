<?php

namespace App\Presentation\Filament\Resources\Contas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ContasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make("cor")->label(""),

                TextColumn::make("nome")->label("Nome da Conta")->weight("bold")->searchable()->sortable(),

                TextColumn::make("tipo")
                    ->label("Tipo")
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            "corrente" => "success",
                            "poupanca" => "info",
                            "digital" => "primary",
                            "carteira" => "gray",
                            "investimento" => "warning",
                            default => "gray",
                        },
                    )
                    ->formatStateUsing(
                        fn(string $state): string => match ($state) {
                            "corrente" => "Corrente",
                            "poupanca" => "Poupança",
                            "digital" => "Digital",
                            "carteira" => "Carteira",
                            "investimento" => "Investimento",
                            default => ucfirst($state),
                        },
                    )
                    ->searchable()
                    ->sortable(),

                TextColumn::make("saldo_atual")
                    ->label("Saldo Atual")
                    ->money("BRL")
                    ->color(fn($state): string => $state >= 0 ? "success" : "danger")
                    ->sortable(),

                TextColumn::make("instituicao")
                    ->label("Instituição")
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                ToggleColumn::make("ativo")->label("Ativo")->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
