<?php

namespace App\Enums;

/**
 * This is an enum as in my experience it's easier to store these types of values
 * as an enum in code, instead of creating a DB table and join queries when pulling data.
 */
enum WineSort: string
{
    case PROKUPAC = 'prokupac';
    case TAMJANIKA = 'tamjanika';
    case CHARDONNAY = 'chardonnay';
    case SOUVIGNON = 'souvignon';
}
