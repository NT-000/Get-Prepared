<x-layout title="Jobs">
    <div class="bg-blue-900 h-25 -px-4 mb-4 flex justify-center items-center rounded">
        <x-search/>
    </div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Browse Jobs</h1>
        <p class="text-gray-600">
            <i class="fa-solid fa-briefcase mr-2"></i>
            <strong>{{$jobs->total()}}</strong> {{$jobs->total() === 1 ? 'job' : 'jobs'}} available
        </p>
    </div>

    <div class="grid gap-4 grid-cols-1 md:grid-cols-3 xl:grid-cols-4">
        @forelse($jobs as $job)
            <a href="{{route('jobs.show', $job)}}" class="block h-full no-underline">
                <x-job-card :job="$job"/>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fa-solid fa-briefcase-blank text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Jobs Available</h3>
                <p class="text-gray-500">Check back later for new opportunities.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{$jobs->links()}}
    </div>
</x-layout>

