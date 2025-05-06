<?php

namespace Modules\Admin\App\Http\Resources\Category;

use App\Http\Resources\BaseResource;

class CategoryResource extends BaseResource
{
    public function index()
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'position' => $this->resource->position,
            'status' => $this->resource->status,
        ];
    }
}
