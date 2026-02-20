<?php

namespace App\Domain\Finance\Enums;

enum StatusTransacao: string
{
    case PENDENTE = 'pendente';
    case CONFIRMADA = 'confirmada';
    case CANCELADA = 'cancelada';
}
