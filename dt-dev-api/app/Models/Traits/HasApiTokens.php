<?php


namespace App\Models\Traits;

use Laravel\Sanctum\HasApiTokens as HasApiTokensBase;
use Laravel\Sanctum\NewAccessToken;

trait HasApiTokens
{
    use HasApiTokensBase;

    public ?NewAccessToken $newAccessToken;

    public ?NewAccessToken $newRefreshToken;

    public function withNewAccessToken(NewAccessToken $newAccessToken): static
    {
        $this->newAccessToken = $newAccessToken;
        $this->withAccessToken($newAccessToken->accessToken);

        return $this;
    }

    public function withNewRefreshToken(NewAccessToken $newRefreshToken): static
    {
        $this->newRefreshToken = $newRefreshToken;

        return $this;
    }
}
