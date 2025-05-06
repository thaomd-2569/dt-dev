<?php

namespace Modules\Admin\App\Http\Resources\Admin;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class AdminResource extends BaseResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->resource->id,
            'login_id' => $this->resource->login_id,
            'role' => $this->resource->role,
        ];
    }
}
