<x-layout title="Dashboard">


    <section x-data="{open: false}">
        <button x-on:click="open = !open">Change profile info</button>
        <div x-show="open">
            <form action=""></form>
            <p>{{$user->name}}:</p>
            <x-input type="text" name="name" :value="old('title', $user->name)"/>
            <p>{{$user->email}}:</p>
            <x-input type="text" name="email" :value="old('title', $user->email)"/>
        </div>
    </section>
    <h1 class="bg-white font-bold text-3xl p-8 mb-2 rounded-lg shadow-md w-full text-center">{{$user->name}}'s Job
        listings</h1>

    @forelse($userJobs as $job)
        <div class="mt-4">
            <x-nav-link :isJobListing="true" url="jobs/{{$job->id}}">
                <x-job-card :job="$job"></x-job-card>
            </x-nav-link>
        </div>
    @empty
        <p>You don't have any active job listings at the moment.</p>
    @endforelse
</x-layout>
