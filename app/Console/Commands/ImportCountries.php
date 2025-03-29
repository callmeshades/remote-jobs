<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-countries {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all countries from the provided JSON file';

    /**
     * Execute the console command.
     * Import all countries from the provided remote JSON file.
     * The JSON file can be found at: https://github.com/dr5hn/countries-states-cities-database
     */
    public function handle()
    {
        // Fetch the JSON
        $json = Http::get($this->argument('url'))->json();

        // Create each country if it doesn't exist
        foreach ($json as $country) {
            Country::firstOrCreate([
                'name' => $country['name'],
                'alpha_two_code' => $country['iso2'],
                'alpha_three_code' => $country['iso3'],
                'numeric_code' => $country['numeric_code'],
            ]);
        }
    }
}
