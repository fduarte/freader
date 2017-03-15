<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TmdbFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmdb:fetcher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from The Movie Db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

        $moviesPopular = $responsePopular->getBody();
        $moviesConfiguration = $responseConfiguration->getBody();

        // Save into DB
//        DB::transaction(function ($moviesPopular, $moviesConfiguration) {
            DB::insert(
                'insert into api_data (name, category, data, created_at) values (?, ?, ?, ?)',
                ['tmdb', 'movies', $moviesPopular, Carbon::now()]
            );
//        });
//        DB::transaction(function ($moviesConfiguration) {
            DB::insert(
                'insert into api_data (name, category, data, created_at) values (?, ?, ?, ?)',
                ['tmdb', 'movies', $moviesConfiguration, Carbon::now()]
            );
//        });
    }
}
