<?php

namespace App\Presentation\Filament\Resources\Parcelas;

use App\Domain\Finance\Models\Parcela;
use App\Domain\Finance\Models\Transacao;
use App\Presentation\Filament\Resources\Parcelas\Pages\ManageParcelas;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParcelaResource extends Resource
{
    protected static ?string $model = Parcela::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $recordTitleAttribute = "numero_parcela";

    protected static ?string $navigationLabel = "Parcelas";

    protected static ?int $navigationSort = 8;

    public static function getNavigationGroup(): ?string
    {
        return "Meu Dinheiro";
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Dados da Parcela")
                ->columns(['default' => 1, 'md' => 2])
                ->schema([
                    Select::make("transacao_id")
                        ->label("Transação")
                        ->options(
                            fn() => Transacao::where('user_id', auth()->id())
                                ->pluck('descricao', 'id'),
                        )
                        ->searchable()
                        ->required(),

                    TextInput::make("numero_parcela")
                        ->label("Número da Parcela")
                        ->required()
                        ->numeric(),

                    TextInput::make("valor")
                        ->label("Valor")
                        ->prefix('R$')
                        ->required()
                        ->numeric(),

                    DatePicker::make("data_vencimento")
                        ->label("Data de Vencimento"),

                    DatePicker::make("data_pagamento")
                        ->label("Data de Pagamento"),

                    Select::make("status")
                        ->label("Status")
                        ->options([
                            'pendente' => 'Pendente',
                            'paga' => 'Paga',
                            'atrasada' => 'Atrasada',
                        ])
                        ->default('pendente'),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make("numero_parcela"),
            TextEntry::make("valor"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("numero_parcela")
            ->columns([
                TextColumn::make("numero_parcela")->label("Parcela"),
                TextColumn::make("valor")->money("BRL"),
                TextColumn::make("data_vencimento")->label("Vencimento"),
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
            "index" => ManageParcelas::route("/"),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
