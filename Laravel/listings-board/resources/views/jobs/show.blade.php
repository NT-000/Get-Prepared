@props(['isConverted' => true])

<x-layout>

    <div></div>
    @php
        if (!empty($job)) {
            $address = $job->address . ', ' . $job->zipcode . ' ' . $job->city . ', ' . $job->country;
            $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($address);
        }
    @endphp
    <section class="md:max-w-2/3">

        @auth
            @if(auth()->user()->id == $job->user_id)
                <div class="fixed top-2/5 right-2/5 p-2 gap-4 z-10">
                    <x-button-link bgClass="bg-blue-500" hoverClass="hover:bg-blue-600" textClass="text-white"
                                   :url="route('jobs.edit', $job->id)">Edit job
                    </x-button-link>

                    <form method="POST" class="mt-4" action="{{route('jobs.destroy', $job->id)}}"
                          onsubmit="return confirm('Are you sure you want to delete listing?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-2 rounded-md cursor-pointer">
                            Delete
                        </button>
                    </form>

                </div>
            @endif
        @endauth
        <div class="text-black rounded-lg shadow-md bg-white p-4">
            <div>
                <h1 class="text-2xl font-bold">{{$job->company_name}}</h1>
                <h2 class="text-xl font-semibold">
                    {{$job->title}}
                </h2>
            </div>
            <p class="text-gray-700 text-lg mt-2">
                {{$job->description}}
            </p>


            <div class="relative flex-wrap items-center space-between gap-4">

                <div class="h-50 w-50">
                    @if($job->company_logo)
                        <img src="{{asset($job->company_logo)}}" alt="{{$job->company_name}} logo"
                             class="rounded-2xl w-80 h-45 bg-transparent my-3">
                    @endif

                </div>
                <ul class="absolute align-middle justify-center top-0 left-1/3 bg-gray-100 p-2 rounded">
                    <h2 class="relative pl-3 text-lg font-semibold text-slate-900">Contact info </h2>
                    @if($job->company_website)
                        <li class="hover:brightness-125 no-underline text-blue-400">
                            <i class="fa-solid fa-globe text-blue-500 mr-2"></i>
                            <a href="{{$job->company_website}}">Visit Company Website</a>
                        </li>
                    @endif

                    @if($job->contact_phone)
                        <li>
                            <p><i class="fa-solid fa-phone text-green-500 mr-2"></i>{{$job->contact_phone}}</p>
                        </li>
                    @endif

                    <li class="hover:brightness-125 text-blue-400">
                        <i
                            class="fa-solid fa-envelope text-blue-500 mr-2"></i>
                        <a href="mailto:{{$job->contact_email}}">Apply for job</a>
                    </li>

                    <x-currency-converter :job="$job"/>

                    <li class="mb-2">
                        @if($job->address)

                            <p>
                                <i class="fa-solid fa-location-dot text-blue-500 mr-2"></i>
                                <a href="{{ $mapsUrl }}" target="_blank"
                                   class="hover:brightness-125 text-blue-400">
                                    {{ $address }}
                                </a>
                                <span
                                    class="text-xs {{$job->remote ? 'bg-red-500' : 'bg-blue-500'}} text-white rounded-full px-4 ml-2">
                                    {{$job->remote ? 'Remote' : 'On-Site'}}
                                </span>
                                @if($job->job_type === 'Full-time')
                                    <span
                                        class="text-xs bg-green-700 text-white rounded-full px-4 ml-2">{{$job->job_type}}</span>
                                @elseif($job->job_type === 'Part-time')
                                    <span
                                        class="text-xs bg-yellow-500 text-white rounded-full px-4 ml-2">{{$job->job_type}}</span>
                                @else
                                    <span
                                        class="text-xs bg-blue-700 text-white rounded-full px-4 ml-2">{{$job->job_type}}</span>
                        @endif
                    </li>

                    @endif


                </ul>
            </div>
            @if($job->requirements)
                <ul class="bg-gray-100 p-4 rounded mb-2">
                    <strong class="relative pl-3 text-lg font-semibold text-slate-900">Requirements</strong>
                    @php
                        $requirements = explode('-', $job->requirements);
                    @endphp
                    @forelse($requirements as $req)
                        <li class="mb-1"><i class="fa-solid fa-circle-check text-blue-500 mr-2"></i>{{trim($req)}}</li>
                    @empty
                        <li>No requirements listed.</li>
                    @endforelse
                </ul>
            @endif

            @if($job->benefits)
                <div class="relative bg-gray-100 p-4 rounded mb-2">
                    <strong class="relative pl-3 text-lg font-semibold text-slate-900 mb-2">Benefits</strong>
                    @php $benefits = explode(',', $job->benefits); @endphp

                    @forelse($benefits as $benefit)
                        <p><i class="fa-solid fa-hand-point-right text-green-500"></i> {{$benefit}}</p>
                    @empty
                        <p>No Benefits Listed.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </section>
</x-layout>
