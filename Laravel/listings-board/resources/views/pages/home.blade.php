<x-layout title="Home">
    <h2 class="text-center text-3xl mb-4 font-bold p-3 rounded text-white text-shadow-black">Newest
        jobs</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 rounded p-5">
        @forelse($jobs as $job)
            <x-nav-link url="/jobs/{{$job->id}}" :isJobListing="true" display="block h-full">
                <x-job-card :job="$job"/>
            </x-nav-link>
        @empty
            <p>There's no available jobs.</p>
        @endforelse
    </div>
    <x-bottom-banner/>
</x-layout>

