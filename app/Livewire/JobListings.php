<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class JobListings extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public function render()
    {
        /**
         * Filter the jobs
         */
        $jobs = (new Job)->newQuery();

        /**
         * If search is present, filter the jobs
         */
        if ($this->search) {
            $jobs->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhereHas('employer', function (Builder $query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        }

        return view('livewire.job-listings', [
            'jobs' => $jobs->with(['employer'])->latest()->simplePaginate(10)
        ]);
    }
}
