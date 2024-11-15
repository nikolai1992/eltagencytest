<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Film;

class FrontController extends Controller
{
	public function index()
	{
        $films = Film::where('status', true)
            ->with([
                'tags',
                'casteFields'
            ])
            ->select(
                'id',
                'name',
                'description',
                'poster',
                'video_id',
                'year',
                'status',
                'premier_start',
                'premier_end',
            )
            ->paginate(10);

		return view('front.main', compact('films'));
	}
}
