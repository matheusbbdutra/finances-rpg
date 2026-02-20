<?php

namespace App\Domain\Finance\Filament\Resources\Contas\Pages;

use App\Domain\Finance\Filament\Resources\Contas\ContaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConta extends CreateRecord
{
    protected static string $resource = ContaResource::class;
}
