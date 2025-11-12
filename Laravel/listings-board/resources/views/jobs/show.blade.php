@props(['isConverted' => true])

<x-layout>
    <section>
        <div class="text-black rounded-lg shadow-md bg-white p-4">
            <div class="flex items-center space-between gap-4">
                <img src="{{asset($job->company_logo)}}" alt="{{$job->company_name}} logo" class="w-24 h-24">
            </div>

            <div>
                <h1 class="text-2xl font-bold">{{$job->company_name}}</h1>
                <h2 class="text-xl font-semibold">
                    {{$job->title}}
                </h2>

            </div>
            <p class="text-gray-700 text-lg mt-2">
                {{$job->description}}
            </p>
            <ul class="my-4 bg-gray-100 p-4 rounded">
                <li class="mb-2">
                    <strong>Salary:</strong> @if($isConverted)
                        ${{round($job->salary/10.12)}}
                    @else
                        {{$job->salary}} kr
                    @endif
                </li>
                <li class="mb-2">
                    <strong>Location:</strong>{{$job->city}}, {{$job->country}}
                    <span
                        class="text-xs {{$job->remote ? 'bg-red-500' : 'bg-blue-500'}} text-white rounded-full px-4 ml-2">
                    {{$job->remote ? 'Remote' : 'On-Site'}}
                </span>
                    <span class="text-xs bg-blue-700 text-white rounded-full px-4 ml-2">{{$job->job_type}}</span>
                </li>

                <li class="mb-2">
                    <strong>Tags:</strong>
                    <span>{{$job->tags}}</span>
                </li>
            </ul>

            <strong>Requirements</strong>
            <ul class="bg-gray-100 p-4 rounded mb-2">
                @php
                    $requirements = explode('-', $job->requirements);
                @endphp
                @forelse($requirements as $req)
                    <li class="mb-1">» {{trim($req)}}</li>
                @empty
                    <li>No requirements listed.</li>
                @endforelse
            </ul>
            <div class="mb-2">
                <strong>Benefits</strong>
                @php $benefits = explode(',', $job->benefits) @endphp

                @forelse($benefits as $benefit)
                    <p>» {{$benefit}}</p>
                @empty
                @endforelse
            </div>

            <ul class="bg-gray-100 p-2 rounded">
                <h2 class="font-semibold">Contact info:</h2>
                @if($job->contact_website)
                    <li>
                        <p><strong>Website:</strong>{{$job->contact_website}}</p>
                    </li>
                @endif

                @if($job->contact_phone)
                    <li>
                        <p><strong>Phone:</strong>{{$job->contact_phone}}</p>
                    </li>
                @endif

                <li>
                    <p><strong>Email:</strong>{{$job->contact_email}}</p>
                </li>
                @if($job->address)
                    <li>
                        <p><strong>Address:</strong>{{$job->address}} @if($job->zipcode)
                                , {{$job->zipcode}}</p>
                        @endif
                    </li>
                @endif
            </ul>

        </div>
    </section>
</x-layout>
