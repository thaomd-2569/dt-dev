<?php

namespace Modules\Admin\App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\NewAccessToken;
use Modules\Admin\App\Contracts\Repositories\UserTokenPairRepositoryInterface;
use Modules\Admin\App\Models\Manager;

class AuthService
{
    protected UserTokenPairRepositoryInterface $tokenPairRepository;

    protected int $expiresAccessToken; // minutes

    protected int $expiresRefreshToken; // minutes

    public function __construct(UserTokenPairRepositoryInterface $tokenPairRepository)
    {
        $this->tokenPairRepository = $tokenPairRepository;

        $this->expiresAccessToken = config('admin.auth.expires.access_token');
        $this->expiresRefreshToken = config('admin.auth.expires.refresh_token');
    }

    public function login(Manager $admin): Manager
    {
        return DB::transaction(function () use ($admin) {
            [$newAccessToken, $newRefreshToken] = $this->generateTokenPair($admin);

            $admin->withNewAccessToken($newAccessToken);
            $admin->withNewRefreshToken($newRefreshToken);

            return $admin;
        });
    }

    public function logout(Manager $admin)
    {
        $admin->currentAccessToken()->delete();
    }

    public function refreshToken(Manager $admin): Manager
    {
        $refreshToken = $admin->currentAccessToken();
        $tokenPair = $this->tokenPairRepository->findPairByRefreshTokenId($refreshToken->getKey());

        return DB::transaction(function () use ($admin, $tokenPair, $refreshToken) {
            if ($tokenPair) {
                $admin->tokens()->where('id', $tokenPair->access_token_id)->delete();
            }

            $refreshToken->delete();

            [$newAccessToken, $newRefreshToken] = $this->generateTokenPair($admin);

            $admin->withNewAccessToken($newAccessToken);
            $admin->withNewRefreshToken($newRefreshToken);

            return $admin;
        });
    }

    protected function generateTokenPair(Manager $admin): array
    {
        $newAccessToken = $this->createAccessToken($admin);
        $newRefreshToken = $this->createRefreshToken($admin);

        return [$newAccessToken, $newRefreshToken];
    }

    protected function createAccessToken(Manager $admin): NewAccessToken
    {
        return $admin->createToken(
            'admin_access_token',
            ['admin'],
            now()->addMinutes($this->expiresAccessToken)
        );
    }

    protected function createRefreshToken(Manager $admin): NewAccessToken
    {
        return $admin->createToken(
            'admin_refresh_token',
            ['admin.refresh_token'],
            now()->addMinutes($this->expiresRefreshToken)
        );
    }
}
