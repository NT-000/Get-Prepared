@props(['job', 'isConverted' => false])

<x-nav-link href="/jobs/{{$job->id}}" :isJobListing="true">
    <div class="rounded-lg shadow-md bg-white p-4 mb-4 hover:brightness-95">

        <div title="Click for more details" class="grid-cols-1 items-center space-between gap-4">
            <div class="flex items-center space-between gap-4">
                <img src="{{asset($job->company_logo)}}" alt="{{$job->company_name}} logo" class="rounded w-2xs h-2xs">
                <div>
                    <h3 class="font-semibold italic">
                        {{$job->company_name}}
                    </h3>
                    <h2 class="text-xl font-semibold">
                        {{$job->title}}
                    </h2>
                    <p class="text-sm text-gray-700">{{$job->job_type}} <span
                            class="text-xs {{$job->remote ? 'bg-red-500' : 'bg-blue-500'}} text-white rounded-full px-2 ml-2">
                        {{$job->remote ? 'Remote' : 'On-Site'}}
                    </span></p>
                </div>
            </div>
            <p class="text-gray-700 text-lg mt-2">
                {{$job->company_description}}
            </p>


            <ul class="my-4 bg-gray-100 p-4 rounded opacity-95">
                <li class="mb-2">
                    <strong>Salary:</strong> @if($isConverted)
                        ${{round($job->salary/10.12)}}
                    @else
                        {{$job->salary}} kr
                    @endif
                </li>
                <li class="mb-2">
                    <strong>Location:</strong>{{$job->city}}, {{$job->country}}
                </li>
                <li class="mb-2">
                    <strong>Tags:</strong>
                    <span>{{$job->tags}}</span>
                </li>
            </ul>

        </div>
    </div>
</x-nav-link>
