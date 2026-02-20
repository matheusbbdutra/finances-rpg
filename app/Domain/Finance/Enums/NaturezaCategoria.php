<?php

namespace App\Domain\Finance\Enums;

enum NaturezaCategoria: string
{
    case RECEITA = 'receita';
    case DESPESA = 'despesa';
    case AMBAS = 'ambas';
}
