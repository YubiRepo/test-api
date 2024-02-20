<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
