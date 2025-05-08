<?php

namespace Modules\Admin\App\Http\Resources\Auth;

use App\Http\Resources\BaseResource;
use App\Models\User\Admin;
use Illuminate\Http\Request;
use Modules\Admin\App\Http\Resources\Admin\AdminResource;

/**
 * @class AuthResource
 *
 * @property Admin $resource
 */
class AuthResource extends BaseResource
{
    public function toArray(Request $request)
    {
        return [
            'access_token' => new NewAccessTokenResource($this->resource->newAccessToken),
            'refresh_token' => new NewAccessTokenResource($this->resource->newRefreshToken),
            'admin' => new AdminResource($this->resource),
        ];
    }

    public function refreshToken(): array
    {
        return [
            'access_token' => new NewAccessTokenResource($this->resource->newAccessToken),
            'refresh_token' => new NewAccessTokenResource($this->resource->newRefreshToken),
        ];
    }

    public function me()
    {
        return $this->resource;
    }
}
