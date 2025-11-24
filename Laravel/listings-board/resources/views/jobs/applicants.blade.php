<x-layout title="Applicants for {{$job->title}}">
    <div class="mb-6">
        <a href="{{route('dashboard.index')}}" class="text-blue-500 hover:underline">
            <i class="fa-solid fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{$job->title}}</h1>
        <p class="text-gray-600">{{$job->company_name}}</p>
        <p class="text-sm text-gray-500 mt-2">
            <i class="fa-solid fa-users mr-2"></i>
            <strong>{{$applicants->total()}}</strong> {{$applicants->total() === 1 ? 'applicant' : 'applicants'}}
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        @forelse($applicants as $applicant)
            <div class="relative bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
                 x-data="{open: false}">

                <form method="POST" action="{{route('jobs.applicants.destroy',[$job, $applicant])}}"
                      onsubmit="return confirm('Are you sure you want to delete this application?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="absolute text-xl right-4 top-4 text-red-500 hover:red-600 cursor-pointer"><i
                            class="fa-solid fa-xmark"></i>
                    </button>
                </form>

                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800">{{$applicant->full_name}} </h3>
                            @if($applicant->location)
                                <span
                                    class="inline-block mt-2 px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                                    <i class="fa-solid fa-location-dot mr-1"></i>
                                    {{$applicant->location}}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="p-6 border-b border-gray-200 flex items-center gap-4">
                    @if($applicant->user && $applicant->user->avatar)
                        <img src="{{asset('storage/' . $applicant->user->avatar)}}"
                             alt="{{$applicant->full_name}}"
                             class="w-16 h-16 rounded-full object-cover">
                    @else
                        <div
                            class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-xl font-bold">
                            {{strtoupper(substr($applicant->full_name, 0, 1))}}
                        </div>
                    @endif
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700">Applied by</h4>
                        <p class="text-sm text-gray-600">{{$applicant->user ? $applicant->user->name : 'Unknown User'}}</p>
                    </div>
                </div>

                <div class="p-6 space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fa-solid fa-envelope w-6 text-blue-500"></i>
                        <a href="mailto:{{$applicant->contact_email}}"
                           class="text-blue-600 hover:underline">
                            {{$applicant->contact_email}}
                        </a>
                    </div>

                    <div class="flex items-center text-gray-700">
                        <i class="fa-solid fa-phone w-6 text-green-500"></i>
                        <a href="tel:{{$applicant->contact_phone}}"
                           class="hover:text-blue-600">
                            {{$applicant->contact_phone}}
                        </a>
                    </div>

                    <button @click="open = !open"
                            class="w-full mt-4 flex items-center justify-between px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                        <span class="font-medium text-gray-700">
                            <i class="fa-solid fa-message mr-2"></i>
                            View Message
                        </span>
                        <i class="fa-solid fa-chevron-down transition-transform"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open"
                         x-transition
                         class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-gray-700 text-sm leading-relaxed">
                            {{$applicant->message ?? 'No message provided.'}}
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0">
                    <a href="{{asset('storage/' . $applicant->resume_path)}}"
                       download="{{$applicant->full_name}}_resume.pdf"
                       class="w-full inline-flex items-center justify-center px-4 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors shadow-sm hover:shadow-md">
                        <i class="fa-solid fa-download mr-2"></i>
                        Download Resume (PDF)
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fa-solid fa-users-slash text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Applicants Yet</h3>
                <p class="text-gray-500">This job hasn't received any applications yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{$applicants->links()}}
    </div>
</x-layout>
