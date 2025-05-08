<?php

namespace Modules\Admin\App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseController;
use Modules\Admin\App\Http\Resources\Auth\AuthResource;

class AuthController extends BaseController
{
    public function __construct(
    ) {}

    public function profile()
    {
        return new AuthResource(auth()->user, __FUNCTION__);
    }
}
