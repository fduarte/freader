<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use App\ApiData;
use Illuminate\Support\Facades\Log;

class HnFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hn:fetcher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch HN data';

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
            'base_uri' => env('HN_URI'),
            // You can set any number of default request options.
            'timeout'  => 5.0,
        ]);

        /**
         * Get HN top stories
         */
        try {
            $resPopular = $client->request(
                'GET',
                env('HN_BASE_URI') . 'topstories.json'
            );
            $idsTopStories = json_decode($resPopular->getBody()->getContents());
        } catch (ClientException $e) {
            Log::alert('Problem importing HN top stories ' . Psr7\str($e->getResponse));
        }

        /**
         * DEBUG
         */
        /*
        // Get HN top stories ids from DB
        $idsTopStories = ApiData::where('name', 'hn')
            ->where('sub_category', 'top stories')
            ->orderBy('created_at', 'desc')
            ->first(['data']);
        $idsTopStories = json_decode($idsTopStories->data);
        dd($idsTopStories[0]);
        */

        $topStories = '';
        $counter = 0;
        while ($counter <= 25) {
            try {
                $resItem = $client->request(
                    'GET',
                    env('HN_BASE_URI') . "item/" . $idsTopStories[$counter] . ".json"
                );
                $topStories[] = $resItem->getBody()->getContents();
            } catch (ClientException $e) {
                echo Psr7\str($e->getRequest());
                echo Psr7\str($e->getResponse());
                dd("\n\n BAD TIMES \n\n");
            }

            $counter++;
        }

        // Save hn top stories
        $apiData = new ApiData();
        $apiData->name = 'hn';
        $apiData->category = 'news';
        $apiData->sub_category = 'top stories';
        $apiData->data = json_encode($topStories);
        $apiData->created_at = Carbon::now();
        $apiData->save();

    }
}
