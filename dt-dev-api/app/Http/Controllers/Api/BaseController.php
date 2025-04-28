<?php

namespace App\Http\Controllers\Api;

use App\Concerns\ExpectResponseJson;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    use ExpectResponseJson;
}
