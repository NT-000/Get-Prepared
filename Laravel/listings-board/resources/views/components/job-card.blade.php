@props(['job', 'isConverted' => false])

<article class="h-full">
    <div title="Click for more details"
         class="items-center space-between gap-4 rounded-2xl hover:brightness-95 shadow p-4 h-full bg-white">
            <div class="flex items-start gap-3">
                <img src="{{asset($job->company_logo)}}" alt="{{$job->company_name}} logo" class="rounded w-12 h-12">
                <div>

                    <h3 class="text-l font-semibold">
                        {{$job->title}}
                    </h3>
                    <p class="text-sm text-gray-700">{{$job->job_type}} <span
                            class="text-xs {{$job->remote ? 'bg-red-500' : 'bg-blue-500'}} text-white rounded-full px-2 ml-2">
                        {{$job->remote ? 'Remote' : 'On-Site'}}
                    </span></p>
                </div>
            </div>

            <ul class="my-1 bg-gray-100 p-2 rounded opacity-95">
                <li class="mb-1">
                    <strong><i class="fa-solid fa-coins text-blue-500 mr-2"></i></strong> @if($isConverted)
                        ${{number_format($job->salary/10.12)}}
                    @else
                        {{number_format($job->salary)}} kr
                    @endif
                </li>
                <li class="mb-2">
                    <strong> <i class="fa-solid fa-location-dot text-blue-500 mr-2"></i></strong>{{$job->city}}
                    , {{$job->country}}
                </li>
                <li class="mb-2">
                    <strong class="text-sm"><i
                            class="fa-solid fa-tags text-blue-500"></i>
                        <span class="ml-1"> {{ucwords(str_replace(',', ', ',$job->tags))}}</span>
                    </strong>
                </li>
            </ul>

    </div>
</article>
