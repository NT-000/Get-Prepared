@props(['job', 'isConverted' => false])

<x-nav-link href="/jobs/{{$job->id}}" :isJobListing="true">
    <section class="hover:brightness-95 my-2">
        <div class="text-black brightness-200 rounded-lg shadow-md bg-white p-4">
            <div class="flex items-center space-between gap-4">
                <img src="{{$job->company_logo}}" alt="{{$job->company_name}} logo" class="rounded">
            </div>

            <div>
                <div class="font-semibold">
                    {{$job->company_name}}
                </div>
                <h2 class="text-xl font-semibold">
                    {{$job->title}}
                </h2>

                <p class="text-sm text-gray-700">{{$job->job_type}}</p>
            </div>
            <p class="text-gray-700 text-3xs mt-2">
                {{$job->company_description}}
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
                        class="text-xs {{$job->remote ? 'bg-red-500' : 'bg-blue-500'}} text-white rounded-full px-2 ml-2">
                    {{$job->remote ? 'Remote' : 'On-Site'}}
                </span>
                </li>
                <li class="mb-2">
                    <strong>Tags:</strong>
                    <span>{{$job->tags}}</span>
                </li>
            </ul>

        </div>
    </section>
</x-nav-link>
