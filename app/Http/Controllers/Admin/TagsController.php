<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsStoreRequest;
use App\Http\Requests\TagsUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        $tag = new Tag();
        $title = 'Додавання нового тегу';

        return view('admin.tags.form', compact('tag', 'title'));
    }

    public function store(TagsStoreRequest $request)
    {
        $data = $request->validated();
        Tag::create($data);
        \Session::flash('flash_message', 'Фільм доданий.');

        return redirect()->route('tags.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $title = 'Редагування тегу';

        return view('admin.tags.form', compact('tag', 'title'));
    }

    public function update(TagsUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $tag = Tag::findOrFail($id);
        $tag->update($data);
        \Session::flash('flash_message', 'Тег оновлений.');

        return redirect()->route('tags.index');
    }

    public function destroy($id)
    {
        Tag::destroy($id);
        \Session::flash('flash_message', 'Тег видалений.');

        return redirect()->route('tags.index');
    }
}
