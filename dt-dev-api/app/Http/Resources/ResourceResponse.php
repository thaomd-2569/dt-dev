<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceResponse as BaseResourceResponse;
use Illuminate\Support\Collection;

class ResourceResponse extends BaseResourceResponse
{
    use ExpectDecorateResourceResponse;

    public function toResponse($request)
    {
        return $this->toResponseBase($request);
    }

    protected function wrap($data, $with = [], $additional = []): array
    {
        if ($data instanceof Collection) {
            $data = $data->all();
        }

        return array_merge_recursive($data, $with, $additional);
    }
}
