<?php

namespace Database\Seeders;

use Modules\Admin\App\Models\ManagerRole;
use Illuminate\Database\Seeder;

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
            ]
        ]);
    }
}
