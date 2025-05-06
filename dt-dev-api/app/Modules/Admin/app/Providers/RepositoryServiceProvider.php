<?php

namespace App\Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        \Modules\Admin\App\Contracts\Repositories\ManagerRepositoryInterface::class => \Modules\Admin\App\Repositories\Eloquent\ManagerRepository::class,
        \Modules\Admin\App\Contracts\Repositories\UserTokenPairRepositoryInterface::class => \Modules\Admin\App\Repositories\Eloquent\UserTokenPairRepository::class,
        \Modules\Admin\App\Contracts\Repositories\CategoryRepositoryInterface::class => \Modules\Admin\App\Repositories\Eloquent\CategoryRepository::class,
    ];
}
