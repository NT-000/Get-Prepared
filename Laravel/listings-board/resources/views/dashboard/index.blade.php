<x-layout title="Dashboard">
    <h1 class="bg-white font-bold text-3xl p-8 mb-2 rounded-lg shadow-md w-full text-center">{{$user->name}}'s Job
        listings </h1>
    <section class="flex" x-data="{
    open: false,
    previewImage(event){
    const file = event.target.files?.[0];
    if(!file) return;
    if(!file.type.startsWith('image/')) return;
    const reader = new FileReader();
    reader.onload = (e) => this.preview = e.target.result;
    reader.readAsDataURL(file);
    }
    }"
    >
        <button x-cloak x-show="!open"
                class="p-2 rounded-lg bg-blue-800 hover:bg-blue-900 text-white shadow-md cursor-pointer w-full"
                @click="open=true">
            Edit profile <i class="fa-solid fa-user-pen"></i>
        </button>
        <div class="bg-white shadow-md p-2 mt-2" x-cloak x-show="open">
            <button x-cloak x-show="open"
                    title="Cancel changes"
                    x-transition
                    class="absolute right-0 top-0 text-xl p-1 rounded-lg text-white cursor-pointer mb-2"
                    @click="open=false">
                <i class="fa-solid fa-xmark text-red-400 hover:text-red-600"></i>
            </button>

            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col items-center mb-4">
                    <img class="rounded-full border-4 border-gray-200 w-32 h-32 object-cover mb-2"
                         alt="avatar preview"
                         :src="preview"/>
                    <p class="text-sm text-gray-600">Image Preview</p>
                </div>

                <x-input type="text" name="name" label="Name" value="{{$user->name}}"/>
                <x-input type="text" name="email" label="Email" value="{{$user->email}}"/>
                Upload Avatar
                <input
                    type="file"
                    class="block w-full text-sm text-gray-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700"
                    accept="image/*"
                    @change="previewImage($event)"
                    name="avatar"
                />
                <button
                    class="p-2 rounded-lg bg-green-500 hover:bg-green-600 cursor-pointer text-white shadow-md w-full"
                    type="submit">
                    Save changes
                </button>
            </form>

        </div>
    </section>
    <div class="flex gap-4 mt-4">
        @forelse($userJobs as $job)
            <a href="{{route('jobs.show', $job)}}" class="block h-full">
                <x-job-card :job="$job" :showApplicants="true"></x-job-card>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fa-solid fa-briefcase text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Job Listings Yet</h3>
                <p class="text-gray-500 mb-6">You haven't created any job listings yet.</p>
                <a href="{{route('jobs.create')}}"
                   class="inline-block px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold transition">
                    <i class="fa-solid fa-plus mr-2"></i>Create Your First Job
                </a>
            </div>
        @endforelse
    </div>
    <x-bottom-banner/>
</x-layout>
