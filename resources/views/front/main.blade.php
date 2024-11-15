@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($films as $film)
                <div class="col-md-2">
                    <a href="{{ route('filmShow', $film->id) }}" style="text-decoration: none; text-underline: none; color: black;">
                        <h3><b>{{ $film->name }}</b></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ $film->poster }}" style="width: 100%;">
                                <p>{{ $film->year }}, {{ $film->casteFields->where('type', 'director')->first()->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $films->links() }}
        </div>
    </div>
@endsection
