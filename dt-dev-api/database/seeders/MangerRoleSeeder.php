<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\App\Models\ManagerRole;

class MangerRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ManagerRole::insert([
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'Admin',
            ],
        ]);
    }
}
