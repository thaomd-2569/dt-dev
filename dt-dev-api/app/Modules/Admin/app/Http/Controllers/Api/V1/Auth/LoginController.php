<?php

namespace Modules\Admin\App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\RateLimiter;
use Modules\Store\App\Contracts\Repositories\AdminRepositoryInterface;
use Modules\Store\App\Http\Requests\Auth\LoginRequest;
use Modules\Store\App\Http\Resources\Auth\AuthResource;
use Modules\Store\App\Services\Admin\AdminService;
use Modules\Store\App\Services\Admin\AuthService;

class LoginController extends BaseController
{
    // protected AuthService $authService;

    // protected AdminService $adminService;

    // protected AdminRepositoryInterface $adminRepository;

    protected int $maxAttempts = 100;

    protected int $lockoutSeconds = 300;

    public function __construct(
        // AuthService $authService,
        // AdminService $adminService,
        // AdminRepositoryInterface $adminRepository
    ) {
        // $this->authService = $authService;
        // $this->adminService = $adminService;
        // $this->adminRepository = $adminRepository;
    }

    public function login()
    {
    }
}
