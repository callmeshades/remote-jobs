<?php

namespace App\Processors;

use App\Models\Employer;
use App\Models\Job;
use App\Utils\URL;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Storage;
use Log;
use Symfony\Component\DomCrawler\Crawler;

class JobspressoProcessor
{
    /**
     * Will process and save a job in the database
     * @param array $job
     * @return void
     * @throws ConnectionException
     */
    public function process(array $job): void
    {
        /**
         * Remove the utm_source from the query parameters
         */
        $url = JobspressoProcessor::stripUrl($job['job']['application_url']);

        /**
         * Check if the job exists, if it does, skip creating it
         */
        $exists = Job::where('url', '=', $url)->exists();
        if ($exists) {
            return;
        }

        /**
         * Create the logo for the company, if it fails, abort.
         */
        $image = $this->createLogo($job['employer']['logo']);
        if (!$image['success']) {
            Log::info("Failed to save/create the image for the employer. Url: {$job['employer']['logo']}");
            return;
        }

        /**
         * Create the employer
         */
        $employer = Employer::create([
            'name' => $job['employer']['name'],
            'logo' => $image['path']
        ]);

        /**
         * Create the description for the job
         */
        $description = strlen($job['job']['description']->text()) > 255 ? substr($job['job']['description']->text(), 0, 255) : $job['job']['description']->text();

        /**
         * Create the job
         */
        Job::create([
            'title' => $job['job']['title'],
            'description' => $description,
            'body' => $job['job']['description']->html(),
            'url' => $url,
            'type' => JobspressoProcessor::getJobType($job['job']['categories']),
            'employer_id' => $employer->id
        ]);
    }

    /**
     * Will strip the utm_source query parameter from the URL
     * @param string $url
     * @return string
     */
    private static function stripUrl(string $url): string
    {
        return URL::removeQueryParameter($url, 'utm_source');
    }

    /**
     * Will attempt to find the job type in the job categories
     * @param Crawler $categories
     * @return string|null
     */
    private static function getJobType(Crawler $categories): ?string
    {
        foreach ($categories as $category) {
            switch (strtolower($category->textContent)) {
                case 'full time':
                    return 'Full Time';
                case 'part time':
                    return 'Part Time';
                case 'contract':
                    return 'Contract';
            }
        }

        return null;
    }

    /**
     * Will fetch and store the Employers logo
     * @param string $logoUrl
     * @return array
     * @throws ConnectionException
     */
    protected function createLogo(string $logoUrl): array
    {
        $response = \Http::get($logoUrl);
        $contents = $response->getBody()->getContents();
        $fileName = basename($logoUrl);
        $path = "companies/logos/$fileName";
        $success = Storage::disk('files')->put($path, $contents);
        return [
            'success' => $success,
            'path' => $path
        ];
    }
}
