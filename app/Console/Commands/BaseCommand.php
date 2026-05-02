<?php

namespace App\Console\Commands;

use App\Traits\Miscellaneous\BaseCommandTrait;
use Illuminate\Console\Command;

abstract class BaseCommand extends Command
{
    use BaseCommandTrait;

    /** @var string */
    protected $signature;
}
