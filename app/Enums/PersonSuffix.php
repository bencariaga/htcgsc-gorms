<?php

namespace App\Enums;

use App\Traits\Has\HasValues;

enum PersonSuffix: string
{
    use HasValues;

    case SR = 'Sr.';
    case JR = 'Jr.';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';
    case VI = 'VI';
}
