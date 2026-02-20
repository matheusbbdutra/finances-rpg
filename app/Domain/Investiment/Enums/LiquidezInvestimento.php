<?php

namespace App\Domain\Investiment\Enums;

enum LiquidezInvestimento: string
{
    case DIARIA = 'diaria';
    case CARESCIDA = 'carescida';
    case VENCIMENTO = 'vencimento';
}
