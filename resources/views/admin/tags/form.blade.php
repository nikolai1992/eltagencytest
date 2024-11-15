<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\films\Service $tag
 */
?>

@extends('layouts.admin')

@section('title', $title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <form method="post" action="{{ $tag->id ? route('tags.update', $tag->id) : route('tags.store') }}" enctype="multipart/form-data">
            @csrf
            @if($tag->id)
                <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="pad col-md-6">
                        <label for="name_en">Назва en</label>
                        <input class="form-control" id="name_en" oninput="generateSlug()" name="name[en]" value="{{ $tag->getTranslation('name', 'en') ? $tag->getTranslation('name', 'en') : old('name.en') }}">
                    </div>
                    <div class="pad col-md-6">
                        <label for="name_uk">Назва uk</label>
                        <input class="form-control" id="name_uk" name="name[uk]" value="{{ $tag->getTranslation('name', 'uk') ? $tag->getTranslation('name', 'uk') : old('name.uk') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="slug">Slug</label>
                        <input class="form-control" id="slug" name="slug" value="{{ $tag->slug ? $tag->slug : old('slug') }}" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                    <a href="{{ route('tags.index') }}" class="btn btn-warning">Відміна</a>
                </div>
            </div>
        </form>

    </div>
@stop

@section('js')
    @parent
    <script>
        function generateSlug() {
            let name = document.getElementById('name_en').value;
            let slug = name.toLowerCase() .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
                         .replace(/\s+/g, '-') // Replace spaces with hyphens
                         .replace(/-+/g, '-');
            console.log(slug);
            document.getElementById('slug').value = slug;
        }
    </script>
@stop


