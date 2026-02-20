<?php

namespace App\Domain\Finance\Enums;

enum TipoTransacao: string
{
    case RECEITA = "receita";
    case DESPESA = "despesa";
    case TRANSFERENCIA = "transferencia";
    case ESTORNO = "estorno";
}
