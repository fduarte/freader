<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\ApiData;

class ApiHackerNewsController extends Controller
{
    public function index(Request $request)
    {

        // Get latest popular movies & configuration (used to generate img links)
        $movies = ApiData::orderBy('created_at', 'desc')->limit(2)->get();

        $moviesPopular = json_decode($movies[0]['data']);
        $moviesConfiguration = json_decode($movies[1]['data']);

        return view('tech-news.index', [
            'moviesPopular' => $moviesPopular,
            'moviesConfiguration' => $moviesConfiguration
        ]);
    }
    //
}
