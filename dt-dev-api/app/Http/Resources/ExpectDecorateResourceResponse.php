<?php

namespace App\Http\Resources;

use App\Concerns\ExpectResponseJson;
use Illuminate\Http\Request;

trait ExpectDecorateResourceResponse
{
    use ExpectResponseJson;

    protected function toResponseBase(Request $request)
    {
        return tap($this->getResponseBase($request), function ($response) use ($request) {
            $response->original = $this->resource->resource;

            $this->resource->withResponse($request, $response);
        });
    }

    protected function getResponseBase(Request $request)
    {
        return $this
            ->setResponseJsonHttpStatusCode($this->calculateStatus())
            ->setResponseJsonData(
                $this->wrap(
                    $this->resource->resolve($request),
                    $this->resource->with($request),
                    $this->resource->additional
                )
            )
            ->setResponseJsonOptions($this->resource->jsonOptions())
            ->responseJson();
    }
}
