<?php

namespace Modules\Admin\App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Eloquent\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Admin\App\Contracts\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    public function model(): string
    {
        return Category::class;
    }

    public function getCategories(array $conditions): Collection
    {
        return $this->model
            ->newQuery()
            ->where($conditions)
            ->orderBy('position')
            ->get();
    }
}
