<?php

namespace Database\Seeders;

use App\Models\CasteField;
use Illuminate\Database\Seeder;

class CasteFieldSeeder extends Seeder
{
	public function run(): void
	{
        CasteField::factory(500)->create();
	}
}
