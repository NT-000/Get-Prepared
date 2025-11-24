<x-layout title="Home">
    <h2 class="text-center text-3xl mb-4 font-bold p-3 rounded text-white text-shadow-black"></h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 rounded p-5">
        @forelse($jobs as $job)
            <a href="{{route('jobs.show', $job)}}" class="block h-full no-underline">
                <x-job-card :job="$job"/>
            </a>
        @empty
            <p>There's no available jobs.</p>
        @endforelse
    </div>
    <x-bottom-banner/>
</x-layout>

