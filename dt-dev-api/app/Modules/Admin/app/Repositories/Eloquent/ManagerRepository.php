<?php

namespace Modules\Admin\App\Repositories\Eloquent;

use App\Repositories\Eloquent\AbstractRepository;
use Modules\Admin\App\Contracts\Repositories\ManagerRepositoryInterface;
use Modules\Admin\App\Models\Manager;

class ManagerRepository extends AbstractRepository implements ManagerRepositoryInterface
{
    public function model(): string
    {
        return Manager::class;
    }

    public function findLogin(array $conditions): ?Manager
    {
        return $this->model
            ->newQuery()
            ->when(!empty($conditions['login_id']), function ($query) use ($conditions) {
                $query->where('login_id', $conditions['login_id']);
            })
            ->first();
    }
}
