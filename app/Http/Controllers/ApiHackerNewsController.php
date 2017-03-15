<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiHackerNewsController extends Controller
{
    public function index(Request $request)
    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => env('MOVIE_DB_BASE_URI'),
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);


        $responsePopular = $client->request(
            'GET',
            '3/movie/popular?api_key=' . env('MOVIE_DB_API_KEY') . '&language=en-US&page=1'
        );

        $responseConfiguration = $client->request(
            'GET',
            '3/configuration?api_key=' . env('MOVIE_DB_API_KEY')
        );

        return view('tech-news.index', [
            'moviesPopular' => json_decode($responsePopular->getBody()),
            'moviesConfiguration' => json_decode($responseConfiguration->getBody())
        ]);
    }
    //
}
