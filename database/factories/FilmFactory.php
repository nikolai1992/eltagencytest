<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FilmFactory extends Factory
{
	protected $model = Film::class;

	public function definition(): array
	{
        $videoIds = [
            'vKQi3bBA1y8',
            'hxkKeniT-0Q',
            'mqqft2x_Aa4',
            'M7XM597XO94'
        ];

		return [
			'name'          => [
                'en' => $this->faker->name(),
                'uk' => $this->faker->name(),
            ],
			'description'   => [
                'en' => $this->faker->text(),
                'uk' => $this->faker->text(),
            ],
			'poster'        => '/images/poster' . rand(1, 4) . '.jpg',
			'video_id'      => $videoIds[rand(0, 3)],
			'year'          => rand(1917, 2024),
			'status'        => $this->faker->boolean(),
			'premier_start' => Carbon::now(),
			'premier_end'   => Carbon::now()->addDays(30),
			'created_at'    => Carbon::now(),
			'updated_at'    => Carbon::now(),
			'screenshots'   => [
                '/images/scrennshot1.jpg',
                '/images/scrennshot2.jpg'
            ],
		];
	}
}
