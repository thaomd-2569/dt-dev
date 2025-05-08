<?php

namespace Modules\Admin\App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Admin\App\Models\Manager;

class ActivityReportPolicy
{
    use HandlesAuthorization;

    public function updateStatus(Manager $manager, Category $category)
    {
        return $manager->isAdmin();
    }
}
