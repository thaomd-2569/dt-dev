<?php

namespace Modules\Admin\App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Modules\Admin\App\Contracts\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getCategories(array $conditions = []): Collection
    {
        return $this->repository->getCategories($conditions);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }
}
