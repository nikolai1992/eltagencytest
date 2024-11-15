<?php

namespace Database\Seeders;

use App\Models\CasteField;
use App\Models\Film;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
	public function run(): void
	{
		Film::factory(500)->create()->each(function($a) {
            $a->tags()->sync(
                Tag::orderBy(\DB::raw('RAND()'))->take(rand(1, 4))->pluck('id')
            );
            $a->casteFields()->sync([
                CasteField::orderBy(\DB::raw('RAND()'))->where('type', 'director')->first()->id,
                CasteField::orderBy(\DB::raw('RAND()'))->where('type', 'screenwriter')->first()->id,
                CasteField::orderBy(\DB::raw('RAND()'))->where('type', 'actor')->first()->id,
                CasteField::orderBy(\DB::raw('RAND()'))->where('type', 'actor')->first()->id,
                CasteField::orderBy(\DB::raw('RAND()'))->where('type', 'actor')->first()->id,
                CasteField::orderBy(\DB::raw('RAND()'))->where('type', 'composer')->first()->id,
            ]);
        });
	}
}
