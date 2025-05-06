<?php

namespace App\Contracts\Repositories;

use App\Models\UserTokenPair;

interface UserTokenPairRepositoryInterface extends RepositoryInterface
{
    public function createPair($userId, $accessTokenId, $refreshTokenId): UserTokenPair;

    public function findPairByAccessTokenId($accessTokenId): ?UserTokenPair;

    public function findPairByRefreshTokenId($refreshTokenId): ?UserTokenPair;
}
