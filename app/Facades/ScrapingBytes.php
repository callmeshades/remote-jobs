<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ScrapingBytes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'scrapingbytes';
    }
}
