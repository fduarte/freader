<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\ApiData;
//use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class ApiHackerNewsController extends Controller
{
    public function index(Request $request)
    {

        // Get latest popular movies & configuration (used to generate img links)
        $movies = ApiData::orderBy('created_at', 'desc')->limit(2)->get();

        // Get only the data field since that's where the json for the popular movies and config is
        $moviesPopular = json_decode($movies[0]['data']);
//        dd($movies[0]['data']);
//        dd(json_decode($movies[0]['data']));
//        dd($moviesPopular);
//        dd($moviesPopular->results);
        $paginate = 3;
        $page = Input::get('page', 1);
//        $moviesPopular = new Paginator(array_slice($moviesPopular->results, $page), 3);

        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($moviesPopular->results, $offSet, $paginate, true);
        $moviesPopular = new LengthAwarePaginator($itemsForCurrentPage, count($moviesPopular->results), $paginate, $page);



        $moviesPopular->render('vendor.pagination.bootstrap-4');
//        dd($moviesPopular->items());


//        $items = $moviesPopular->items();
//        dd($items['results']);
//        foreach($moviesPopular as $m) {
//            var_dump($m[1]);
//        }
//        exit;
//        dd($paginator);
//        $moviesPopular = json_decode($movies[0]['data']);
        $moviesConfiguration = json_decode($movies[1]['data']);

        return view('tech-news.index', [
            'moviesPopular' => $moviesPopular,
            'moviesConfiguration' => $moviesConfiguration
        ]);
    }
    //
}
