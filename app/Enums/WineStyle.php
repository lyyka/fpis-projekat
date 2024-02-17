<?php

namespace App\Enums;

/**
 * This is an enum as in my experience it's easier to store these types of values
 * as an enum in code, instead of creating a DB table and join queries when pulling data.
 */
enum WineStyle: string
{
    case RED = 'red';
    case WHITE = 'white';
    case ROSE = 'rose';
    case BUBBLE = 'bubble';
    case DESERT = 'desert';
}
