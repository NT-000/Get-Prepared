@props(['job', 'currencies', 'exchange'])

<div x-data="{
exCurrencyFrom: 'NOK',
currencyTo: 'EUR',
salary: {{$job->salary}},
currencyObject: 0,

async getRates(){
console.log('inside calculate')
let response = await fetch(`https://api.frankfurter.dev/v1/latest?amount=${this.salary}&from=NOK&to=${this.currencyTo}`);
console.log('Salary:', this.salary, 'Currency:', this.currencyTo)
this.currencyObject = await response.json();
console.log('currencyObject: ',this.currencyObject)
}

} " x-init="getRates()">
    <div>
        <div class="flex">
            <div x-cloak x-show="currencyObject.amount" x-text="currencyObject.amount"></div>
            NOK
        </div>
        <select @change="getRates()" x-model="currencyTo" :value="currencyTo">
            <option value="" selected></option>
            @forelse($currencies as $currency)
                <option>{{$currency}}</option>
            @empty
                Empty
            @endforelse
        </select>
        <div x-text="currencyObject.rates?.[currencyTo] || 'Select currency'"></div>
    </div>

</div>
<input type="hidden" name="currencyTo" :value="currencyTo">
