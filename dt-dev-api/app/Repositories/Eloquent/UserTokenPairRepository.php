<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\UserTokenPairRepositoryInterface;
use App\Models\UserTokenPair;

abstract class UserTokenPairRepository extends AbstractRepository implements UserTokenPairRepositoryInterface
{
    public function model(): string
    {
        return UserTokenPair::class;
    }

    public function createPair($userId, $accessTokenId, $refreshTokenId): UserTokenPair
    {
        $model = new UserTokenPair([
            'user_id' => $userId,
            'access_token_id' => $accessTokenId,
            'refresh_token_id' => $refreshTokenId,
        ]);

        $this->save($model);

        return $model;
    }

    public function findPairByAccessTokenId($accessTokenId): ?UserTokenPair
    {
        return $this->model
            ->newQuery()
            ->where('access_token_id', $accessTokenId)
            ->first();
    }

    public function findPairByRefreshTokenId($refreshTokenId): ?UserTokenPair
    {
        return $this->model
            ->newQuery()
            ->where('refresh_token_id', $refreshTokenId)
            ->first();
    }
}
