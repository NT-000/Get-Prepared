<x-layout title="Create Job">
    <h1 class="font-semibold">Create New Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <x-input text="text" name="title" placeholder="What's the job title?" key="title" val="title"/>

        <x-input type="text" name="description" placeholder="Enter description of job." key="description"
                 val="description"/>

        <button class="border-2 py-1 px-1 rounded border-solid border-black bg-blue-600 opacity-80 text-white"
                type="submit">Submit
            form
        </button>
    </form>
</x-layout>
