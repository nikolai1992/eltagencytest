<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CasteFieldStoreRequest;
use App\Http\Requests\CasteFieldUpdateRequest;
use App\Models\CasteField;
use App\Models\Film;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;

class CasteFieldsController extends Controller
{
    private ImageService $imageService;

    public function __construct()
    {
        $this->imageService = app(ImageService::class);
    }

	public function index()
	{
        $casteFields = CasteField::paginate(10);
        return view('admin.caste-fields.index', compact('casteFields'));
	}

	public function create()
	{
        $casteField = new CasteField();
        $title = "Додавання нового поля касту";

        return view('admin.caste-fields.form', compact('casteField', 'title'));
	}

	public function store(CasteFieldStoreRequest $request)
	{
        $data = $request->validated();
        $data = $this->imageService->saveImage($data, 'photo');
        CasteField::create($data);
        \Session::flash('flash_message', 'Поле касту створене.');

        return redirect()->route('caste-fields.index');
	}

	public function show($id)
	{
	}

	public function edit($id)
	{
        $casteField = CasteField::findOrFail($id);
        $title = "Редагування поля касту";

        return view('admin.caste-fields.form', compact('casteField', 'title'));
	}

	public function update(CasteFieldUpdateRequest $request, $id)
	{
        $data = $request->validated();
        $casteField = CasteField::findOrFail($id);
        $data = $this->imageService->saveImage($data, 'photo', $casteField->photo);
        $casteField->update($data);
        \Session::flash('flash_message', 'Поле касту оновлено.');

        return redirect()->route('caste-fields.index');
	}

	public function destroy($id)
	{
        $casteField = CasteField::findOrFail($id);
        $this->imageService->deleteImage($casteField->photo);
        $casteField->delete();
        \Session::flash('flash_message', 'Поле касту видалено.');

        return redirect()->route('caste-fields.index');
	}
}
