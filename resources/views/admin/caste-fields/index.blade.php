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
        <h1>Перелік полів касту </h1>
    </div><br>
    <div class="row">
        <a href="{{route('caste-fields.create')}}">
            <button class="btn btn-sm btn-primary">Додати новий</button>
        </a>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Фото</th>
                    <th>Імʼя</th>
                    <th>Тип</th>
                    <th class="text-center">Дії</th>
                </tr>
                </thead>
                @foreach($casteFields as $casteField)
                    <tr>
                        <td>{{$casteField->id}}</td>
                        <td>
                            <img style="width: 100px;" src="{{asset($casteField->photo)}}">
                        </td>
                        <td>{{$casteField->name}}</td>
                        <td>
                            @lang('site-labels.caste_field_type.' . $casteField->type)
                        </td>
                        <td class="text-center">
                            <a href="{{ route('caste-fields.edit', $casteField->id) }}"
                               class="text-info btn btn-link"><i class="fa fa-pencil"></i></a>
                            <form method="POST" action="{{ route('caste-fields.destroy', $casteField->id) }}" >
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
                    <th>Фото</th>
                    <th>Імʼя</th>
                    <th>Тип</th>
                    <th class="text-center">Дії</th>
                </tr>
                </tfoot>
            </table>
            <div class="pagination">
            {{ $casteFields->links() }}
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
