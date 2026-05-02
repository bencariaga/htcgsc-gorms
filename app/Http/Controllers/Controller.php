<?php

namespace App\Http\Controllers;

use App\Traits\Miscellaneous\ProvidesMessages;
use Illuminate\Foundation\{Auth\Access\AuthorizesRequests, Validation\ValidatesRequests};
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ProvidesMessages, ValidatesRequests;
}
