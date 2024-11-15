<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilmsStoreRequest;
use App\Http\Requests\FilmsUpdateRequest;
use App\Models\CasteField;
use App\Models\Film;
use App\Models\Tag;
use App\Services\Image\ImageService;

class FilmController extends Controller
{
    private ImageService $imageService;

    public function __construct()
    {
        $this->imageService = app(ImageService::class);
    }

	public function index()
	{
        $films = Film::all();

		return view('admin.films.index', compact('films'));
	}

	public function create()
	{
        $title = 'Додавання нового фільму';
        $film = new Film();
        $tags = Tag::select(['name', 'id'])->get();
        $casteFields = CasteField::select(['name', 'type', 'id'])->get();

        return view('admin.films.form', compact(
            'title',
            'film',
            'tags',
            'casteFields',
        ));
	}

	public function store(FilmsStoreRequest $request)
	{
        $data = $request->validated();
        $data['status'] = $request->has('status') ? true : false;
        $data = $this->imageService->saveImage($data, 'poster');
        $film = Film::create($data);

        $film->tags()->sync($request->tag_ids);
        $film->casteFields()->sync($request->caste_field_ids);

        \Session::flash('flash_message', 'Фільм доданий.');

        return redirect()->route('films.index');
	}

	public function show($id)
	{

	}

	public function edit($id)
	{
        $film = Film::findOrFail($id);
        $title = 'Редагування фільму';
        $tags = Tag::select(['name', 'id'])->get();
        $casteFields = CasteField::select(['name', 'type', 'id'])->get();

        return view('admin.films.form', compact(
            'film',
            'title',
            'tags',
            'casteFields'
        ));
	}

	public function update(FilmsUpdateRequest $request, $id)
	{
        $data = $request->validated();
        $data['status'] = $request->has('status') ? true : false;
        $film = Film::findOrFail($id);
        $data = $this->imageService->saveImage($data, 'poster', $film->poster);
        $film->update($data);
        $film->tags()->sync($request->tag_ids);
        $film->casteFields()->sync($request->caste_field_ids);

        \Session::flash('flash_message', 'Дані фільму оновлені.');

        return redirect()->route('films.index');
	}

	public function destroy($id)
	{
        $film = Film::find($id);
        $this->imageService->deleteImage($film->poster);
        $film->delete();
        \Session::flash('flash_message', 'Фільм видалений.');

        return redirect()->route('films.index');
	}
}
