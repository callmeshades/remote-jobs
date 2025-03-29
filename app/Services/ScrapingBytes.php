<?php

namespace App\Services;

use GuzzleHttp\Client;

class ScrapingBytes
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }
}

