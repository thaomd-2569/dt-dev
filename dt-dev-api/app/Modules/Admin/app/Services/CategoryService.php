<?php

namespace Modules\Admin\App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\App\Contracts\Repositories\CategoryRepositoryInterface;
use Modules\Admin\App\Contracts\Repositories\ManagerRepositoryInterface;
use Modules\Admin\App\Models\Manager;

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
}
