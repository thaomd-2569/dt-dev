<?php

namespace App\Http\Resources;

use App\Concerns\ExpectResponseJson;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse as BasePaginatedResourceResponse;
use Illuminate\Support\Arr;

class PaginatedResourceResponse extends BasePaginatedResourceResponse
{
    use ExpectResponseJson;

    public function toResponse($request)
    {
        $response = $this
            ->setResponseJsonHttpStatusCode($this->calculateStatus())
            ->setResponseJsonData(
                $this->wrap(
                    $this->resource->resolve($request),
                    array_merge_recursive(
                        $this->paginationInformation($request),
                        $this->resource->with($request),
                        $this->resource->additional
                    )
                )
            )
            ->setResponseJsonOptions($this->resource->jsonOptions())
            ->responseJson();

        return tap($response, function ($response) use ($request) {
            $response->original = $this->resource->resource->map(function ($item) {
                return is_array($item) ? Arr::get($item, 'resource') : $item->resource;
            });

            $this->resource->withResponse($request, $response);
        });
    }

    protected function paginationInformation($request)
    {
        $paginated = parent::paginationInformation($request);

        if (isset($paginated['meta'])) {
            $paginated['meta'] = Arr::only($paginated['meta'], ['current_page', 'last_page', 'per_page', 'total']);
        }

        return Arr::only($paginated, ['meta']);
    }
}
