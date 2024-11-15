<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\films\Service $film
 */
?>

@extends('layouts.admin')

@section('title', $title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <form method="post" action="{{ $film->id ? route('films.update', $film->id) : route('films.store') }}" enctype="multipart/form-data">
            @csrf
            @if($film->id)
                <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="pad col-md-6">
                        <label for="name_en">Назва en</label>
                        <input class="form-control" name="name[en]" value="{{ $film->getTranslation('name', 'en') }}">
                    </div>
                    <div class="pad col-md-6">
                        <label for="name_uk">Назва uk</label>
                        <input class="form-control" name="name[uk]" value="{{ $film->getTranslation('name', 'uk') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="pad col-md-6">
                        <label for="description_en">Опис en</label>
                        <textarea class="form-control" id="description_en" name="description[en]">{{ $film->getTranslation('description', 'en') }}</textarea>
                    </div>
                    <div class="pad col-md-6">
                        <label for="description_uk">Опис uk</label>
                        <textarea class="form-control" id="description_uk" name="description[uk]">{{ $film->getTranslation('description', 'uk') }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="video_id">ID відео на ютубі</label>
                        <input class="form-control" id="video_id" name="video_id" value="{{ $film->video_id }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="year">Рік випуску</label>
                        <select class="form-control" id="year" name="year">
                            <option label="Виберіть рік випуску"></option>
                            @for($i = 1915; $i <= date('Y') + 1; $i++)
                                <option value="{{$i}}" {{ $film->year == $i ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="premier_start">Дата початку перегляду</label>
                        <input type="datetime-local" class="form-control" id="premier_start" name="premier_start" value="{{ $film->premier_start ? $film->premier_start->format('Y-m-d\TH:i') : '' }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="premier_end">Дата кінця перегляду</label>
                        <input type="datetime-local" class="form-control" id="premier_end" name="premier_end" value="{{ $film->premier_end ? $film->premier_end->format('Y-m-d\TH:i') : '' }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset($film->poster) }}" style="width:200px; {{ $film->poster==null ? "display:none" : '' }}">
                        <label for="poster">Зображення</label>
                        <input type="file" name="poster" id="poster" class="form-control poster"  value="{{ $film->poster }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="status">Активний</label>
                        <input type="checkbox" name="status" {{ $film->status ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-6 ">
                        <label for="order_column">Теги</label>
                        <select name="tag_ids[]" multiple class="select2 form-control">
                            <option value="">Виберіть теги</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $film->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        <label for="caste_field_ids">Поля касту</label>
                        <select name="caste_field_ids[]" multiple class="select2 form-control">
                            <option value="">Виберіть поля касту </option>
                            @foreach($casteFields as $casteField)
                                <option value="{{ $casteField->id }}" {{ $film->casteFields->contains($casteField->id) ? 'selected="selected"' : '' }}>{{ $casteField->name . ', ' . __('site-labels.caste_field_type.' . $casteField->type) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="col-md-12">
                    <div class="h3">Скріншоти</div>
                    <div class=" slider-row">
                        @if($film->screenshots)
                            @foreach($film->screenshots as $image)
                                @include('admin._partials._images', [
                                    'image' => $image,
                                    'field' => 'screenshots'
                                ])
                            @endforeach
                        @else
                            @include('admin._partials._images', [
                                'image' => null,
                                'field' => 'screenshots'
                            ])
                        @endif
                        <div class="small-box">
                            <div class="icon"><i class="ion ion-android-add-circle add-desc"></i></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                    <a href="{{ route('films.index') }}" class="btn btn-warning">Відміна</a>
                </div>
            </div>
        </form>

    </div>
@stop

@section('js')
    @parent
    <script>
        $('body').on('change', '#poster', function(event) {
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

        function addDesc() {
            const count = $('.slider-row .desc').length;
            @php
                $image = false;
            @endphp
            var desc = `@include('admin._partials._images_load', [
                                    'field' => 'screenshots'
                                ])`;
            desc = desc.replace(/\[0\]/gm, '[' + count + ']');
            desc = desc.replace(/_0/gm, '_' + count);
            $(desc).find('.rem-desc').on('click', function () {
                $(this).parents('.small-box').remove();
            });
            $(desc).insertBefore($(this).parents('.small-box'));
            $('#lfm_' + count).filemanager('image');
        }

        $('.add-desc').on('click', addDesc);

        $('body').on('click', '.rem-desc', function(event) {
            $(this).parents('.small-box').remove();
        });
    </script>
@stop


