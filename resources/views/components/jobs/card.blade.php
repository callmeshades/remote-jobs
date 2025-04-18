@props(['job'])

<div class="bg-white overflow-hidden shadow-md rounded-lg hover:shadow-lg transition-shadow duration-300 border border-gray-200 mb-4">
    <div class="p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                <div class="w-16 h-16 flex-shrink-0 rounded-md border border-gray-200 bg-white p-1 overflow-hidden flex items-center justify-center mb-3 sm:mb-0">
                    <img src="{{ Storage::disk('files')->url($job->employer->logo) }}" alt="{{ $job->employer->name }}" class="max-w-full max-h-full object-contain" style="max-width: 56px; max-height: 56px;">
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 hover:text-indigo-600 transition">
                        <a href="#">{{ $job->title }}</a>
                    </h3>
                    <p class="text-md text-gray-700 font-medium">Employer Name</p>
                </div>
            </div>
        </div>

        {{-- Categories & Information --}}
        <div class="flex flex-wrap gap-2 mt-4">
            @if($job->type)
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ $job->type }}
                </span>
            @endif
        </div>

        <div class="mt-4 text-md text-gray-700 line-clamp-1">
            {{ Str::limit(strip_tags($job->description)) }}
        </div>

        <div class="mt-5 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <span class="text-sm text-gray-600 mb-3 sm:mb-0">
                Posted {{ $job->created_at->diffForHumans() }}
            </span>
            <a href="#" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition">
                View Details
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
