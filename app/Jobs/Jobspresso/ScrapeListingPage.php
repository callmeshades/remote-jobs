<?php

namespace App\Jobs\Jobspresso;

use App\Exceptions\SpiderScrapeException;
use App\Spiders\Jobspresso\ListingPageSpider;
use Bus;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Log;
use Throwable;

class ScrapeListingPage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            /**
             * Scrape the listing page and get all links
             */
            $spider = new ListingPageSpider();
            $body = $spider->scrape();
            $links = $spider->parse($body);

            /**
             * Dispatch 5 jobs at a time for scraping.
             * We have a max amount of 5 concurrent connections for ScrapingBytes.
             */
            $chunks = collect($links)->chunk(5);
            $chunks = $chunks->values();

            /**
             * Start scraping the first chunk of links.
             */
            ScrapeListingPage::dispatchSequential($chunks, 0);
        } catch (SpiderScrapeException|GuzzleException $e) {
            Log::warning('Failed to scrape Jobspresso: {error}', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Will dispatch jobs in a recursive and sequential order.
     * @param Collection $chunks
     * @param int $index
     * @return void
     * @throws Throwable
     */
    private static function dispatchSequential(Collection $chunks, int $index): void
    {
        /**
         * Return if the chunk doesn't exist
         */
        if (!isset($chunks[$index])) return;

        /**
         * Create the jobs to dispatch at the current chunk index.
         */
        $jobs = $chunks[$index]->map(fn ($item) => new ScrapeJobPage($item));

        /**
         * Dispatch the jobs, after finished, dispatch the next chunk.
         */
        Bus::batch($jobs)
            ->then(function () use ($chunks, $index) {
                ScrapeListingPage::dispatchSequential($chunks, $index + 1);
            })
            ->dispatch();
    }
}
