<?php

namespace Modules\Admin\App\Contracts\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface as BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getCategories(array $conditions): Collection;
}
