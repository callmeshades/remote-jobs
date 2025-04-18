<div>
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-5 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900">Available Jobs</h2>
            <span class="text-sm font-medium px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full">
                {{ $jobs->count() }} jobs found
            </span>
        </div>

        @forelse($jobs as $job)
            <x-jobs.card :job="$job" />
        @empty
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-8 text-center">
                <div class="flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No jobs found</h3>
                    <p class="text-base text-gray-600 max-w-md">Try adjusting your search criteria or selecting different filters.</p>
                </div>
            </div>
        @endforelse
        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
