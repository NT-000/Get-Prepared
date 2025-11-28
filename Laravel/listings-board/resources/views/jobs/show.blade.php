@props(['isConverted' => true])

<x-layout>

    <div class="flex flex-col lg:flex-row gap-6">
        <section x-data="{isOpen: true}" class="relative flex-1">

            @can('update', $job)
                <button
                    class="absolute top-4 right-2 mb-4 flex gap- text-blue-500 hover:text-blue-700 transition-transform"
                    @click="isOpen = !isOpen">
                    <i class="fa-solid fa-chevron-up transition-transform font-bold"
                       :class="isOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-cloak x-show="isOpen" x-transition class="absolute top-8 right-4 mb-4 flex gap-2">
                    <x-button-link bgClass="bg-blue-500" hoverClass="hover:bg-blue-600" textClass="text-white"
                                   :url="route('jobs.edit', $job->id)">Edit job
                    </x-button-link>

                    <form method="POST" action="{{route('jobs.destroy', $job->id)}}"
                          onsubmit="return confirm('Are you sure you want to delete listing?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="font-bold bg-red-500 hover:bg-red-600 cursor-pointer text-white py-2 px-4 rounded-md">
                            Delete
                        </button>
                    </form>
                </div>
            @endcan

            <div class="text-black rounded-lg shadow-md bg-white p-6">
                <div class="mb-4">
                    <div><h1 class="text-2xl font-bold">{{$job->company_name}}</h1></div>
                    <h2 class="text-xl font-semibold">{{$job->title}}</h2>
                </div>

                <p class="text-gray-700 text-lg mb-6">{{$job->description}}</p>

                @if($job->requirements)
                    <div class="bg-gray-100 p-4 rounded mb-4">
                        <strong class="text-lg font-semibold text-slate-900 mb-2 block">Requirements</strong>
                        <ul>
                            @php
                                $requirements = explode('-', $job->requirements);
                            @endphp
                            @forelse($requirements as $req)
                                <li class="mb-1">
                                    <i class="fa-solid fa-circle-check text-blue-500 mr-2"></i>{{trim($req)}}
                                </li>
                            @empty
                                <li>No requirements listed.</li>
                            @endforelse
                        </ul>
                    </div>
                @endif

                @if($job->benefits)
                    <div class="bg-gray-100 p-4 rounded mb-4">
                        <strong class="text-lg font-semibold text-slate-900 mb-2 block">Benefits</strong>
                        @php $benefits = explode(',', $job->benefits); @endphp
                        @forelse($benefits as $benefit)
                            <p class="mb-1">
                                <i class="fa-solid fa-hand-point-right text-green-500 mr-2"></i>{{trim($benefit)}}
                            </p>
                        @empty
                            <p>No Benefits Listed.</p>
                        @endforelse
                    </div>
                @endif

                @auth
                    <div x-data="{
                        open: false,
                        countryCode: '+47',
                        phoneNumber: '',
                        get fullPhone() {
                            return this.countryCode + this.phoneNumber;
                        }
                    }">
                        @if(auth()->user()->id == $job->user_id)
                            <p class="text-center text-gray-600 bg-gray-100 p-3 rounded">
                                <i class="fa-solid fa-circle-info text-blue-500 mr-2"></i>
                                This is your own listing.
                            </p>
                        @elseif($hasApplied)
                            <p class="text-center text-gray-600 bg-green-50 p-3 rounded">
                                <i class="fa-solid fa-check-circle text-green-500 mr-2"></i>
                                You have already applied to this job
                            </p>
                        @else
                            <button
                                class="hover:brightness-125 text-white cursor-pointer w-full bg-blue-500 p-2 text-center rounded"
                                @click="open = !open">
                                <i class="fa-solid fa-envelope text-white mr-2"></i>
                                Apply for job
                            </button>
                        @endif

                        <div x-cloak x-show="open"
                             class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                            <div @click.away="open = false"
                                 class="bg-white p-6 rounded-lg max-w-md max-h-[90vh] overflow-y-auto">
                                <h3 class="text-xl font-bold mb-4">Apply for {{$job->title}}</h3>

                                @if($errors->any())
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                        <ul class="list-disc list-inside">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{route('jobs.applicants.store', $job->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <x-inputs.input
                                        type="text"
                                        label="Full name"
                                        name="full_name"
                                        placeholder="Please enter your full name"
                                        value="{{auth()->user()->name}}"
                                        :req="true"
                                    />

                                    <x-inputs.input
                                        type="email"
                                        label="Email"
                                        name="contact_email"
                                        placeholder="Please enter your email"
                                        value="{{auth()->user()->email}}"
                                        :req="true"
                                    />

                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-semibold mb-2">Phone</label>

                                        <div class="flex gap-2">
                                            <select x-model="countryCode"
                                                    class="px-3 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                @foreach($landcodes as $lc)
                                                    <option value="{{$lc}}">{{$lc}}</option>
                                                @endforeach
                                            </select>

                                            <input
                                                x-model="phoneNumber"
                                                class="flex-1 px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                type="tel"
                                                placeholder="69273456"
                                                pattern="[0-9]{8}"
                                                maxlength="8"
                                                required>
                                        </div>

                                        <input type="hidden" name="contact_phone" :value="fullPhone">

                                        <small class="text-gray-600 block mt-1">
                                            Full number: <span class="font-semibold" x-text="fullPhone"></span>
                                        </small>
                                    </div>


                                    <x-inputs.input
                                        :isTextarea="true"
                                        label="Message"
                                        name="message"
                                        :req="true"
                                    />

                                    <x-inputs.input
                                        type="text"
                                        label="Location"
                                        name="location"
                                        placeholder="Please enter your location"
                                        :req="true"
                                    />

                                    <x-inputs.input
                                        type="file"
                                        label="Upload resume (PDF)"
                                        name="resume_path"
                                        :req="true"
                                    />
                                    <div class="w-full">
                                        <button type="submit"
                                                class="w-full mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer font-bold">
                                            Submit
                                        </button>
                                        <button type="button" @click="open = false"
                                                class="w-full mt-4 text-black bg-gray-400 px-4 py-2 rounded hover:bg-gray-500 cursor-pointer font-bold">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            @endauth
        </section>

        <aside class="lg:w-64 space-y-4">
            <div class="bg-white rounded-lg shadow-md p-4 flex justify-center">
                @if($job->company_logo)
                    <img src="{{asset($job->company_logo)}}"
                         alt="{{$job->company_name}} logo"
                         class="rounded-2xl max-w-full h-auto object-cover">
                @else
                    <img src="{{asset('logos/def_workland.png')}}"
                         alt="Default company logo"
                         class="rounded-2xl max-w-full h-auto object-cover">
                @endif
            </div>

            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Contact Info</h2>
                <ul class="space-y-3">
                    @if($job->company_website)
                        <li class="hover:brightness-125 text-blue-400">
                            <i class="fa-solid fa-globe text-blue-500 mr-2"></i>
                            <a href="{{$job->company_website}}">Visit Company Website</a>
                        </li>
                    @endif

                    @if($job->contact_phone)
                        <li>
                            <i class="fa-solid fa-phone text-green-500 mr-2"></i>{{$job->contact_phone}}
                        </li>
                    @endif


                    <li>
                        <x-currency-exchange :job="$job" :currencies="$currencies"/>
                    </li>

                    @if($job->address)
                        <li>
                            <x-map :job="$job" :coordinates="$coordinates"/>
                            <p>
                                <i class="fa-solid fa-location-dot text-blue-500"></i>
                                {{$job->address}}
                            </p>
                        </li>
                    @endif

                    @auth
                        <li>
                            @if(auth()->user()->id === $job->user_id)
                                <button type="submit"
                                        class="bg-gray-200 rounded w-full p-2">
                                    <i class="fa-solid fa-circle-info text-blue-500 mr-2"></i>This is your own listing
                                </button>
                            @elseif(auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                                <form method="POST" action="{{route('saved.destroy', $job)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 cursor-pointer font-bold text-white rounded w-full p-2">
                                        Remove Bookmark
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{route('saved.store', $job)}}">
                                    @csrf
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white rounded w-full p-2">
                                        Save Job
                                    </button>
                                </form>
                            @endif
                        </li>
                    @else
                        <li class="text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>You must be logged in to save jobs
                        </li>
                    @endauth
                </ul>
            </div>
        </aside>

    </div>

</x-layout>
