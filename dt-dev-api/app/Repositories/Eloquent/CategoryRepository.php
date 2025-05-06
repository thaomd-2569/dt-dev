<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;

abstract class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    public function model(): string
    {
        return Category::class;
    }
}
