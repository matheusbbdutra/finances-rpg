<?php

namespace App\Domain\Finance\Enums;

enum TipoConta: string
{
    case CORRENTE = "corrente";
    case POUPANCA = "poupanca";
    case DIGITAL = "digital";
    case CARTEIRA = "carteira";
    case INVESTIMENTO = "investimento";
}
