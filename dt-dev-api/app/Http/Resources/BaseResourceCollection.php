<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;

class BaseResourceCollection extends ResourceCollection
{
    use ExpectDecorateResourceResponse, ExpectResolvePurposeMethod;

    protected ?string $purpose;

    public function __construct($resource, ?string $purpose = null)
    {
        $this->purpose = $purpose;

        parent::__construct($resource);
    }

    public function toArray(Request $request)
    {
        return $this->collection->map->resolve($request)->all();
    }

    public function toResponse($request)
    {
        if ($this->resource instanceof AbstractPaginator || $this->resource instanceof AbstractCursorPaginator) {
            return $this->preparePaginatedResponse($request);
        }

        return (new ResourceResponse($this))->toResponse($request);
    }

    protected function preparePaginatedResponse($request)
    {
        if ($this->preserveAllQueryParameters) {
            $this->resource->appends($request->query());
        } elseif (! is_null($this->queryParameters)) {
            $this->resource->appends($this->queryParameters);
        }

        return (new PaginatedResourceResponse($this))->toResponse($request);
    }

    protected function collectResource($resource)
    {
        if ($resource instanceof MissingValue) {
            return $resource;
        }

        if (is_array($resource)) {
            $resource = new Collection($resource);
        }

        $collects = $this->collects();

        $this->collection = $collects && ! $resource->first() instanceof $collects
            ? $this->mapResourceClassInto($resource, $collects)
            : $resource->toBase();

        return $resource instanceof AbstractPaginator || $resource instanceof AbstractCursorPaginator
            ? $resource->setCollection($this->collection)
            : $this->collection;
    }

    protected function mapResourceClassInto($collection, $resourceClass)
    {
        return $collection->map(fn ($value, $key) => new $resourceClass(
            $value,
            $this->hasPurposeMethod() ? null : $this->purpose,
            $key
        ));
    }

    protected function hasPurposeMethod(): bool
    {
        return ! is_null($this->purpose) && method_exists(static::class, $this->purpose);
    }
}
