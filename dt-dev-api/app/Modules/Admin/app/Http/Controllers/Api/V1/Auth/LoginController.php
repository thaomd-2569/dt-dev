<?php

namespace Modules\Admin\App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\RateLimiter;
use Modules\Admin\App\Contracts\Repositories\ManagerRepositoryInterface;
use Modules\Admin\App\Http\Requests\Auth\LoginRequest;
use Modules\Admin\App\Http\Resources\Auth\AuthResource;
use Modules\Admin\App\Services\Admin\AdminService;
use Modules\Admin\App\Services\Admin\AuthService;

class LoginController extends BaseController
{
    protected AuthService $authService;

    protected AdminService $adminService;

    protected ManagerRepositoryInterface $managerRepository;

    protected int $maxAttempts = 100;

    protected int $lockoutSeconds = 300;

    public function __construct(
        AuthService $authService,
        AdminService $adminService,
        ManagerRepositoryInterface $managerRepository
    ) {
        $this->authService = $authService;
        $this->adminService = $adminService;
        $this->managerRepository = $managerRepository;
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $throttleKey = $this->getThrottleKey($data);

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            throw new AuthorizationException('Locked out for too many attempts. Please try again in '.$this->lockoutSeconds.' seconds.');
        }

        $admin = $this->managerRepository->findLogin($data);

        if (! $admin || ! $this->adminService->checkPassword($admin, $data['password'])) {
            RateLimiter::hit($throttleKey, $this->lockoutSeconds);

            throw new AuthenticationException('Invalid login credentials.');
        }

        $admin = $this->authService->login($admin);

        RateLimiter::clear($throttleKey);

        return new AuthResource($admin);
    }

    protected function getThrottleKey(array $data): string
    {
        return 'admin|'.$data['login_id'].'|'.request()->ip();
    }

    public function logout()
    {
        $this->authService->logout(auth()->user());

        return $this->responseSuccess('Logged out successfully.');
    }
}
