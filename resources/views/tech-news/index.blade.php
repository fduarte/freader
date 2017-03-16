@extends('layouts.main')

@section('content')
    <div class="col-12 m-0">
        <h2><i class="fa fa-video-camera" aria-hidden="true"></i> {{ $moviesPopular->total() }} Popular Movies</h2>
        <hr />
        {{ $moviesPopular->links('vendor.pagination.bootstrap-4') }}
    </div>
    @foreach ($moviesPopular->items() as $movie)
        <div class="col-4">
            <div class="card-deck rounded">
                <div class="card">
                    <div class="card-header m-0">
                        <h6 class="card-title m-0">{{ $movie->title }}</h6>
                    </div>
                    <div class="card-block">
                        <img class="rounded float-left mr-2" src="{{ $moviesConfiguration->images->base_url . 'w154/' . $movie->poster_path }}" alt="Card image cap">
                        <p class="card-text">{{ $movie->overview }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Released on {{ $movie->release_date }}</small>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@stop
