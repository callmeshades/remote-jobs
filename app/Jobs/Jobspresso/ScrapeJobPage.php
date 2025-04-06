<?php

namespace App\Jobs\Jobspresso;

use App\Exceptions\SpiderScrapeException;
use App\Processors\JobspressoProcessor;
use App\Spiders\Jobspresso\JobPageSpider;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use InvalidArgumentException;
use Log;

class ScrapeJobPage implements ShouldQueue
{
    use Batchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $link)
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
             * Scrape the job listing page
             */
            $spider = new JobPageSpider();
            $body = $spider->scrape($this->link);
            $job = $spider->parse($body);

            /**
             * Process the job and store it in the database
             */
            $processor = new JobspressoProcessor();
            $processor->process($job);
        } catch (SpiderScrapeException|GuzzleException|InvalidArgumentException $e) {
            Log::warning('Failed to scrape Jobspresso listing page: {error}', ['error' => $e->getMessage()]);
        } catch (ConnectionException $e) {
            Log::warning('Failed to process job: {error}', ['error' => $e->getMessage()]);
        }
    }
}
