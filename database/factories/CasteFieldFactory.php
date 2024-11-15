<?php

namespace Database\Factories;

use App\Models\CasteField;
use Illuminate\Database\Eloquent\Factories\Factory;

class CasteFieldFactory extends Factory
{
	protected $model = CasteField::class;

	public function definition(): array
	{
        $types = ['director', 'screenwriter', 'actor', 'composer'];
        $type = $types[rand(0,3)];
		return [
            'name' => [
                'en' => fake()->name(),
                'uk' => fake()->name(),
            ],
            'photo' => asset('images/' . $type . '.jpg'),
            'type' => $type,
		];
	}
}
