<x-layout>
    <x-slot name="title">Create Job</x-slot>
    <h1 class="font-semibold">Create new job</h1>
    <form class="container mx-auto" action="/jobs" method="POST">
        @csrf
        <x-input text="text" name="title" placeholder="What's the job title?"/>
        <x-input type="text" name="info" placeholder="Enter description of job."/>
        <button class="border-2 py-1 px-1 rounded border-solid border-black bg-blue-600 opacity-80 text-white"
                type="submit">Submit
            form
        </button>
    </form>
</x-layout>
