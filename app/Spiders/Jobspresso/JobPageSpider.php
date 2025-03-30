<?php

namespace App\Spiders\Jobspresso;

use App\Exceptions\SpiderScrapeException;
use App\Facades\ScrapingBytes;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class JobPageSpider
{
    /**
     * @throws GuzzleException
     * @throws SpiderScrapeException
     */
    public function scrape(string $url)
    {
        $response = ScrapingBytes::scrape($url, premiumProxy: true);

        /**
         * Check scraping was successful
         */
        if ($response['status_code'] !== 200) {
            throw new SpiderScrapeException(sprintf("Failed to scrape Jobspresso job page - Status %d", $response['status_code']));
        }

        return $response['response'];
    }

    /**
     * Fetch job listing information
     * @param string $body
     * @return array
     */
    public function parse(string $body): array
    {
        $crawler = new Crawler($body);

        /**
         * Fetch employer information
         */
        $name = $crawler->filterXPath('//li[@class="job-company"]')->text();
        $logo = $crawler->filterXPath('//img[@class="company_logo"]')->attr('src');

        $employer = [
            'name' => $name,
            'logo' => $logo,
        ];

        /**
         * Fetch job listing information
         */
        $title = $crawler->filterXPath('//h1[@class="page-title"]')->text();
        $location = $crawler->filterXPath('//li[@class="location"]')->text();
        $description = $crawler->filterXPath('//div[contains(@class, "job_listing-description")]')->html();
        $applicationUrl = $crawler->filterXPath('//a[contains(@class, "application_button_link")]')->attr('href');
        $category = $crawler->filterXPath('//a[@class="job-category"]')->first()->text();

        $job = [
            'title' => $title,
            'location' => $location,
            'description' => $description,
            'application_url' => $applicationUrl,
            'category' => $category
        ];

        return [
            'employer' => $employer,
            'job' => $job
        ];
    }
}
