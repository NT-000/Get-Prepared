<x-layout>

    <h1>Saved jobs</h1>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
        @forelse($savedJobs as $job)
            <x-nav-link url="/jobs/{{$job->id}}" :isJobListing="true">
                <x-job-card :job="$job"/>
            </x-nav-link>
        @empty
            <p class="text-gray-500 text-center">You got no bookmarked job listings.</p>
        @endforelse
        {{$savedJobs->links()}}
    </div>

</x-layout>
