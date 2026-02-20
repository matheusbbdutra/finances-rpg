<?php

namespace App\Domain\Finance\Filament\Resources\Transacaos\Pages;

use App\Domain\Finance\Filament\Resources\Transacaos\TransacaoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTransacao extends CreateRecord
{
    protected static string $resource = TransacaoResource::class;
}
