<x-layout>

    <h1>Saved jobs</h1>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
        @forelse($savedJobs as $job)
            <x-nav-link :isJobListing="true">
                <x-job-card :job="$job"/>
            </x-nav-link>
        @empty
            <div>You got no bookmarked job listings.</div>
        @endforelse
        {{$savedJobs->links()}}
    </div>

</x-layout>
