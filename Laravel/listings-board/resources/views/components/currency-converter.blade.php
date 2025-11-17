@props(['job','isConverted' => false, 'fromCurrency' => 'NOK', 'toCurrency' => 'USD'])

{{--just for testing--}}
<li class="" x-data="{ isConverted: false }">
    <i class=" fa-solid fa-coins text-blue-500 mr-2
                    "></i>
    <div>
        <span x-show="!isConverted">{{$job->salary}}</span>
        <span x-show="isConverted">{{number_format($job->salary/10.12)}}</span>
        <button title="Change currency" class="hover:cursor-pointer p-1 rounded "
                x-html="`${isConverted ? '{{$toCurrency}}' : '{{$fromCurrency}}'} <i class='fa-solid fa-right-left'></i> ${isConverted ? '{{$fromCurrency}}' : '{{$toCurrency}}'}`"
                x-on:click="isConverted = !isConverted">
        </button>
    </div>
</li>
