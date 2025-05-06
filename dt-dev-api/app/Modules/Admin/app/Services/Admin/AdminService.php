<?php

namespace Modules\Admin\App\Services\Admin;

use Illuminate\Support\Facades\Hash;
use Modules\Admin\App\Contracts\Repositories\ManagerRepositoryInterface;
use Modules\Admin\App\Models\Manager;

class AdminService
{
    protected ManagerRepositoryInterface $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function checkPassword(Manager $admin, string $password): bool
    {
        return Hash::check($password, $admin->getAuthPassword());
    }

    public function changePassword(Manager $admin, string $password): bool
    {
        return $admin->update(['password' => $password]);
    }
}
