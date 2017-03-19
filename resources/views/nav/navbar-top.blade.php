<nav class="navbar navbar-toggleable-md navbar-fixed-top navbar-inverse bg-inverse bg-faded">
    <div class="container">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">{{ strtoupper((env('APP_TITLE'))) }}</a>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item {{ active(['tech-news', 'tech-news/*', 'tech-news.*', 'tech-news'])  }}">
                <a class="nav-link" href="{{ url('tech-news') }}">Tech News <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ active(['movies', 'movies/*', 'movies.*', 'movies']) }} ">
                <a class="nav-link" href="{{ route('movies.index') }}">Movies</a>
            </li>
            <li class="nav-item {{ active(['pocket', 'pocket/*', 'pocket.*', 'pocket']) }}">
                <a class="nav-link" href="{{ url('pocket') }}">Pocket</a>
            </li>
        </ul>
    </div>
    </div>
</nav>