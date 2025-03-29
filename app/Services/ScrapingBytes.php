<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class ScrapingBytes
{
    const API_URL = 'https://scrapingbytes.com/api/v1/';
    private Client $client;

    /**
     * Construct the client and set the API Key
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.scrapingbytes.key')
            ],
            'timeout' => 140
        ]);
    }

    /**
     * Scrape a target website
     * @throws GuzzleException
     */
    public function scrape(
        string $url,
        bool $renderJs = true,
        bool $premiumProxy = false,
        bool $screenshot = false,
        bool $mobile = false,
        bool $blockResources = true,
        bool $blockAds = true,
        int $windowHeight = 1080,
        int $windowWidth = 1920,
        int $timeout = 130,
        ?array $instructions = null
    ): array
    {
        /**
         * Scrape a website using ScrapingBytes
         */
        try {
            $response = $this->client->post('scrape', [
                'url' => $url,
                'render_js' => $renderJs,
                'premium_proxy' => $premiumProxy,
                'screenshot' => $screenshot,
                'mobile' => $mobile,
                'block_resources' => $blockResources,
                'block_ads' => $blockAds,
                'window_height' => $windowHeight,
                'window_width' => $windowWidth,
                'timeout' => $timeout,
                'instructions' => $instructions
            ]);

            /**
             * Get the status code, headers, and return the response.
             * This assumes a successful response
             */
            $responseBody = $response->getBody()->getContents();
            $headers = $response->getHeaders();
            return [
                'status_code' => $response->getStatusCode(),
                'headers' => [
                    'success' => $headers['SB-Success'] ?? null,
                    'credit_cost' => $headers['SB-Credit-Cost'] ?? null,
                ],
                'response' => $responseBody,
            ];
        } catch (ClientException $e) {
            /**
             * Decode the error response.
             */
            $response = $e->getResponse();
            $responseBody = $response->getBody();
            $jsonResponse = json_decode($responseBody, true);

            /**
             * Get the status code, headers, and return the response
             */
            return [
                'status_code' => $response->getStatusCode(),
                'headers' => [
                    'success' => $headers['SB-Success'] ?? null,
                    'credit_cost' => $headers['SB-Credit-Cost'] ?? null,
                ],
                'response' => $jsonResponse
            ];
        }
    }
}

