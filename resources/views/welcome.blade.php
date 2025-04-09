<x-layouts.default>
    <!-- Hero Section -->
    <section class="bg-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-4" style="font-size: 2.25rem; margin-block: 0.67em;">Find Your Remote Job</h1>
                <p class="text-lg sm:text-xl text-gray-700 mb-8">Search thousands of remote jobs across the globe</p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg">Browse Jobs</a>
                </div>
            </div>

            <div class="flex justify-center">
                <img src="{{ Vite::asset('resources/images/remote-work.svg') }}" alt="Remote Work Illustration" class="w-full max-w-xl">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Why Choose Our Job Board</h2>
                <p class="mt-4 text-base sm:text-lg text-gray-600">We connect remote workers with the best opportunities</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <div class="text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">100% Remote Jobs</h3>
                    <p class="text-gray-600">All positions are fully remote, allowing you to work from anywhere.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <div class="text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Daily Updates</h3>
                    <p class="text-gray-600">New remote job opportunities added every day.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <div class="text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Verified Companies</h3>
                    <p class="text-gray-600">All employers are vetted to ensure legitimate opportunities.</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.default>
