<?php


namespace Modules\Admin\App\Http\Resources\Auth;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;

/**
 * @class NewAccessTokenResource
 *
 * @property NewAccessToken $resource
 */
class NewAccessTokenResource extends BaseResource
{
    public function toArray(Request $request)
    {
        return [
            'type' => 'Bearer',
            'plaintext' => $this->resource->plainTextToken,
            'expires_at' => $this->resource->accessToken->expires_at,
        ];
    }
}
