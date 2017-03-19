<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\ApiData;
//use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        // Get latest popular movies & configuration (used to generate img links)
        $movies = ApiData::where('category', 'movies')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // Get only the data field since that's where the json for the popular movies and config is
        $moviesPopular = json_decode($movies[0]['data']);
        $moviesConfiguration = json_decode($movies[1]['data']);

        // Handle pagination
        $paginate = env('PAGINATE');
        $page = Input::get('page', 1);
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($moviesPopular->results, $offSet, $paginate, true);
        $moviesPopular = new LengthAwarePaginator(
            $itemsForCurrentPage,
            count($moviesPopular->results),
            $paginate,
            $page
        );
        $moviesPopular->render('vendor.pagination.bootstrap-4');

        return view('movies.index', [
            'moviesPopular' => $moviesPopular,
            'moviesConfiguration' => $moviesConfiguration
        ]);
    }
    //
}
