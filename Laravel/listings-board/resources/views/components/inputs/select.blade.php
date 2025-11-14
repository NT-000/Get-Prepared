@props(['jobOptions' => ['Yes', 'No'], 'name' => '', 'label' => ''])

<label class="block text-gray-700" for="{{$name}}">{{$label}}</label>
<div class="mb-4">
    <select
        name="{{$name}}"
        class="w-full px-4 py-2 rounded focus:outline-none {{ $errors->has($name) ? 'border-2 border-red-500' : 'border border-gray-300' }}"
        required
    >
        @foreach($jobOptions as $key => $option)
            @php
                $value = is_int($key) ? $option : $key;
            @endphp
            <option value="{{$value}}" {{ (old($name) == $value) || ($loop->first && !old($name)) ? 'selected' : '' }}>
                {{$option}}
            </option>
        @endforeach
    </select>
    @error($name)
    <p class="text-red-600 mt-2 text-sm">{{$message}}</p>
    @enderror
</div>
