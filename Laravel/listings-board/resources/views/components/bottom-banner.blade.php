@props(['h2Title' => 'Ready to Grow Your Team?', 'pTitle' => 'Post your job today and connect with qualified candidates fast.'])

<section class="container mx-auto my-6">
    <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between flex-col md:flex-row gap-4">
        <div>
            <h2 class="text-xl font-semibold">
                {{$h2Title}}
            </h2>
            <p class="text-gray-200 text-lg mt-2">
                {{$pTitle}}
            </p>
        </div>
        <x-button-link url="/jobs/create" icon="edit">Create Job</x-button-link>
    </div>

</section>
