<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'name' => 'Pcs',
			'description' => null
        ]);

        Unit::create([
            'name' => 'Kg',
			'description' => null
        ]);

        Unit::create([
            'name' => 'Porsi',
			'description' => null
        ]);

        Unit::create([
            'name' => 'Ltr',
			'description' => null
        ]);
    }
}
