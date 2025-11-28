@props(['job','isConverted' => false, 'fromCurrency' => 'NOK', 'toCurrency' => 'USD'])

{{--just for testing--}}
<li class="" x-data="{ isConverted: false, showAlert: false }">

    <div
        x-show="showAlert"
        x-transition
        class="fixed top-30 right-100 p-4 mb-4 rounded text-white bg-green-500 shadow-lg z-50"
    >
        Currency converted to <span x-text="isConverted ? '{{$toCurrency}}' : '{{$fromCurrency}}'"></span>!
    </div>

    <div>
        <i class=" fa-solid fa-coins text-blue-500 mr-2"></i>
        <span x-show="!isConverted">{{$job->salary}}</span>
        <span x-show="isConverted">{{number_format($job->salary/10.12)}}</span>
        <button title="Change currency" class="hover:cursor-pointer p-1 rounded "
                x-html="`${isConverted ? '{{$toCurrency}}' : '{{$fromCurrency}}'} <i class='fa-solid fa-right-left'></i> ${isConverted ? '{{$fromCurrency}}' : '{{$toCurrency}}'}`"
                @click="
                    isConverted = !isConverted;
                    showAlert = true;
                    setTimeout(() => showAlert = false, 3000)
                ">
        </button>
    </div>
</li>
