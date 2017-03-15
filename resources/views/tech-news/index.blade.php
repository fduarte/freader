@extends('layouts.main')


@section('content')
    {{--{{ dd($moviesConfiguration) }}--}}
    @foreach ($moviesPopular->results as $movie)
        <div class="col-4">
            <img src="{{ $moviesConfiguration->images->base_url . 'w154/' . $movie->poster_path }}" class="float-left img-fluid img-thumbnail mr-2" alt="{{ $movie->title }}">
            <h4 class="text-primary">{{ $movie->title }}</h4>
            <p class="text-muted">{{ $movie->release_date }}</p>
            <p>{{ $movie->overview }}</p>
        </div>
    @endforeach

@stop
