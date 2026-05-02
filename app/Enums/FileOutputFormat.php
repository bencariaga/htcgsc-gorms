<?php

namespace App\Enums;

use App\Traits\Has\HasValues;

enum FileOutputFormat: string
{
    use HasValues;

    case PDF = 'PDF Document';
    case XLSX = 'Excel Spreadsheet';
}
