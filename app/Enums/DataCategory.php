<?php

namespace App\Enums;

use App\Traits\Has\HasValues;

enum DataCategory: string
{
    use HasValues;

    case Users = 'Users';
    case Students = 'Students';
    case Appointments = 'Form Submissions';
}
