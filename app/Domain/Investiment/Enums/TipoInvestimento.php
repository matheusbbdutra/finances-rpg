<?php

namespace App\Domain\Investiment\Enums;

enum TipoInvestimento: string
{
    case CDB = "cdb";
    case CAIXINHA = "caixinha";
    case ACOES = "acoes";
    case FII = "fii";
    case CRIPTO = "cripto";
    case TESOURO = "tesouro";
    case FUNDO = "fundo";
}
