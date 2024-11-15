<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Film;

class FilmController extends Controller
{
	public function show($id)
	{
		$film = Film::with([
            'tags',
            'casteFields'
        ])->findOrFail($id);

        return view('front.film', compact('film'));
	}
}
