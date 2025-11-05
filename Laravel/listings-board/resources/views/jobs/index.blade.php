<x-layout title="Jobs">
    <h1>{{$title}}</h1>
    <ul>
        @forelse($jobs as $job)
            <li>{{$job}}</li>
        @empty
            <p>There's no jobs in the array.</p>
        @endforelse
    </ul>

</x-layout>

