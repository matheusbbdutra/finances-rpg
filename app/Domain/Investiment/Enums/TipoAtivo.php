<?php

namespace App\Domain\Investiment\Enums;

enum TipoAtivo: string
{
    case ACAO = 'acao';
    case FII = 'fii';
    case ETF = 'etf';
    case BDR = 'bdr';
    case CRIPTO = 'cripto';
}
