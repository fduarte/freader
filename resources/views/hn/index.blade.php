@extends('layouts.main')

@section('content')

    <div class="col-12 m-0">
        <h2><i class="fa fa-news" aria-hidden="true"></i> HN Top Stories</h2>
        <hr />
        {{--{{ $moviesPopular->links('vendor.pagination.bootstrap-4') }}--}}
    </div>

    <?php
        use Carbon\Carbon;
        $topStoriesArray = json_decode($hnTopStories->data);
    ?>

    <ol>
    @foreach ($topStoriesArray as $topStory)
        <?php
            $story = json_decode($topStory);
        ?>
        <li class="mb-2">
            <a href="{{ $story->url or '#' }}">{{ $story->title }}</a>
            <br><small>submitted on: {{ Carbon::createFromTimeStamp($story->time)->toDateTimeString() }} | type: {{ $story->type }} | score: {{ $story->score }}</small>
        </li>
    @endforeach
    </ol>

@stop
