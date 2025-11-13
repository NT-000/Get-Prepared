<x-layout title="Jobs">
    <h1 class="text-2-xl">{{$title}}</h1>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($jobs as $job)
            <x-nav-link url="/jobs/{{$job->id}}" :isJobListing="true" display="block h-full">
                <x-job-card :job="$job" display="block"/>
            </x-nav-link>
        @empty
            <p>There's no jobs in the array.</p>
        @endforelse

    </div>
</x-layout>

