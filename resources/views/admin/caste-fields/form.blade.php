<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\films\Service $casteField
 */
?>

@extends('layouts.admin')

@section('title', $title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <form method="post" action="{{ $casteField->id ? route('caste-fields.update', $casteField->id) : route('caste-fields.store') }}" enctype="multipart/form-data">
            @csrf
            @if($casteField->id)
                <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="pad col-md-6">
                        <label for="name_en">Імʼя en</label>
                        <input class="form-control" name="name[en]" value="{{ $casteField->getTranslation('name', 'en') }}">
                    </div>
                    <div class="pad col-md-6">
                        <label for="name_uk">Імʼя uk</label>
                        <input class="form-control" name="name[uk]" value="{{ $casteField->getTranslation('name', 'uk') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="year">Тип</label>
                        <select class="form-control" id="type" name="type">
                            <option label="Виберіть тип"></option>
                            <option {{ $casteField->type == 'director' ? 'selected' : '' }} value="director">Режисер</option>
                            <option {{ $casteField->type == 'screenwriter' ? 'selected' : '' }} value="screenwriter">Сценарист</option>
                            <option {{ $casteField->type == 'actor' ? 'selected' : '' }} value="actor">Актор</option>
                            <option {{ $casteField->type == 'composer' ? 'selected' : '' }} value="composer">Композитор</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset($casteField->photo) }}" style="width:200px; {{ $casteField->photo==null ? "display:none" : '' }}">
                        <label for="photo">Фото</label>
                        <input type="file" name="photo" id="photo" class="form-control poster"  value="{{ $casteField->photo }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                    <a href="{{ route('caste-fields.index') }}" class="btn btn-warning">Відміна</a>
                </div>
            </div>
        </form>

    </div>
@stop

@section('js')
    @parent
    <script>
        $('body').on('change', '#photo', function(event) {
            readURL(this)
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log($(input).parent().html());

                    $(input).parent().find('img').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop


