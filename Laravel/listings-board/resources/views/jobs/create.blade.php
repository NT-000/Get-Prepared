<x-layout>
    <x-slot name="title">Create Job</x-slot>
    <h1>Create new job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Enter jobtitle">
        <input type="text" name="info" placeholder="Enter description of job.">
        <button type="submit">Submit form</button>
    </form>
</x-layout>
