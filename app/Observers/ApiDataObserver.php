<?php

namespace App\Observers;

use App\ApiData;

class ApiDataObserver
{
    /**
     * Listen to the ApiData created event.
     *
     * @param ApiData $apiData
     */
    public function created(ApiData $apiData)
    {
    }

    /**
     * Listen to ApiData deleting event.
     * 
     * @param ApiData $apiData
     */
    public function deleting(ApiData $apiData)
    {
    }
}