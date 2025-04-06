<?php

namespace App\Console\Commands;

use App\Jobs\Jobspresso\ScrapeListingPage;
use Illuminate\Console\Command;

class ScrapeJobspresso extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-jobspresso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will scrape jobs from Jobspresso';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ScrapeListingPage::dispatch();
    }
}
