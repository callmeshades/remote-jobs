<?php

namespace App\Spiders\Jobspresso;

use App\Exceptions\SpiderScrapeException;
use App\Facades\ScrapingBytes;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class ListingPageSpider
{
    private string $startUrl = 'https://jobspresso.co/remote-work/';

    /**
     * Scrape the website
     * @throws GuzzleException
     * @throws SpiderScrapeException
     */
    public function scrape()
    {
        $response = ScrapingBytes::scrape(
            $this->startUrl,
            premiumProxy: true,
            instructions: [
                ['wait_for' => '.job_listing-clickbox'],
                ['click' => '.load_more_jobs'],
                ['wait' => 5],
                ['click' => '.load_more_jobs'],
                ['wait' => 5],
                ['click' => '.load_more_jobs'],
                ['wait' => 5]
            ]
        );

        if ($response['status_code'] !== 200) {
            throw new SpiderScrapeException(sprintf("Failed to scrape Jobspresso - Status %d", $response['status_code']));
        }

        return $response['response'];
    }

    /**
     * Parse job postings from the listing page.
     * @param string $body
     * @return array
     */
    public function parse(string $body): array
    {
        /**
         * Find all links for a job listing
         */
        $crawler = new Crawler($body);
        $links = $crawler->filterXPath('//a[@class="job_listing-clickbox"]')->links();

        /**
         * Get the URL for each job post
         */
        $urls = [];
        foreach ($links as $link) {
            $urls[] = $link->getUri();
        }

        return $urls;
    }
}
