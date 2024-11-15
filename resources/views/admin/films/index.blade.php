<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

?>
@extends('layouts.admin')

@section('content_header')
    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        </div>
    @endif
@stop

@section('content')
    <br>
    <div class="row">
        <h1>Перелік фільмів</h1>
    </div><br>
    <div class="row">
        <a href="{{route('films.create')}}">
            <button class="btn btn-sm btn-primary">Додати новий</button>
        </a>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Постер</th>
                    <th>Статус</th>
                    <th>Назва</th>
                    <th>ID відео</th>
                    <th>Рік випуску</th>
                    <th class="text-center">Дії</th>
                </tr>
                </thead>
                @foreach($films as $film)
                    <tr>
                        <td>{{$film->id}}</td>
                        <td>
                            <img style="width: 100px;" src="{{asset($film->poster)}}">
                        </td>
                        <td>{{$film->status ? 'Увімкнений' : 'Вимкнений'}}</td>
                        <td>{{$film->name}}</td>
                        <td>{{$film->video_id}}</td>
                        <td>{{ $film->year }}</td>
                        <td class="text-center">
                            <a href="{{route('films.edit',$film->id)}}"
                               class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                            <form method="POST" action="{{ route('films.destroy', $film->id) }}" >
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button onclick="return confirm('Ви впевнені, що хочете видалити цей елемент?')" type="submit" class="delete"  title="Видалити">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Постер</th>
                    <th>Статус</th>
                    <th>Назва</th>
                    <th>ID відео</th>
                    <th>Рік випуску</th>
                    <th class="text-center">Дії</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('js')

@endsection
