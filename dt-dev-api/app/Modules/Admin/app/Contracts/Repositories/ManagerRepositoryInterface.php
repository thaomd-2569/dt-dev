<?php

namespace Modules\Admin\App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;
use Modules\Admin\App\Models\Manager;

interface ManagerRepositoryInterface extends RepositoryInterface
{
    public function findLogin(array $conditions): ?Manager;
}
