<x-layout title="Jobs">
    <h1 class="text-2-xl">{{$title}}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6"></div>
    @forelse($jobs as $job)

        <x-job-card :job="$job">
        </x-job-card>

    @empty
        <p>There's no jobs in the array.</p>
    @endforelse


</x-layout>

