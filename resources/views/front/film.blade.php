@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ $film->poster }}" style="width: 100%;">
            </div>
            <div class="col-md-9">
                <h3><b>{{ $film->name }} ({{ $film->year }})</b></h3>
                <p>{{ $film->casteFields->where('type', 'director')->first()->name }}</p>
                <p>{{ $film->description }}</p>
                <div style="display: flex">
                    @foreach($film->tags as $tag)
                        <button class="btn btn-primary">{{ $tag->name }}</button>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <b>@lang('site-labels.caste_field_type.director'):</b>
                    </div>
                    <div class="col-md-10">
                        @foreach($film->casteFields->where('type', 'director') as $casteField)
                            <span>{{ $casteField->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <b>@lang('site-labels.caste_field_type.screenwriter'):</b>
                    </div>
                    <div class="col-md-10">
                        @foreach($film->casteFields->where('type', 'screenwriter') as $casteField)
                            <span>{{ $casteField->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <b>@lang('site-labels.caste_field_type.composer'):</b>
                    </div>
                    <div class="col-md-10">
                        @foreach($film->casteFields->where('type', 'composer') as $casteField)
                            <span>{{ $casteField->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <b>@lang('site-labels.caste_field_type.actor'):</b>
                    </div>
                    <div class="col-md-10" style="display: flex">
                        @foreach($film->casteFields->where('type', 'actor') as $casteField)
                            <div class="col-md-3">
                                <img src="{{$casteField->photo}}" style="width: 75px; border-radius: 60px;">
                                <span>{{ $casteField->name }}</span>
                            </div>

                        @endforeach
                    </div>
                </div>
                <p><b>@lang('site-labels.premier_start'):</b> {{ $film->premier_start }}</p>
                <p><b>@lang('site-labels.premier_end'):</b> {{ $film->premier_end }}</p>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                @if($film->screenshots)
                    @foreach($film->screenshots as $screenshot)
                        <div class="col-md-12">
                            <img style="width: 100%" src="{{ $screenshot }}"/>
                        </div><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6 align-content-center">
                <iframe width="420" height="315"
                        src="https://www.youtube.com/embed/{{ $film->video_id }}">
                </iframe>
            </div>
        </div>
    </div>
@endsection
