<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\App\Models\Manager;
use Modules\Admin\App\Models\ManagerRole;

class MangerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Manager::insert([
            [
                'login_id' => 'admin',
                'password' => bcrypt('admin'),
                'role_id' => ManagerRole::where('name', 'Admin')->first()->id,
            ],
            [
                'login_id' => 'manager',
                'password' => bcrypt('manager'),
                'role_id' => ManagerRole::where('name', 'Manager')->first()->id,
            ],
        ]);
    }
}
