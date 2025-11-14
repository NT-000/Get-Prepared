@props([
    'type' => 'text',
    'name' => '',
    'placeholder' => 'Enter text',
    'req' => false,
    'key' => '',
    'val' => '',
    'label' => '',
    'isTextarea' => false
    ])



@if($isTextarea)
    <label class="block text-gray-700" for="{{$name}}">{{$label}}</label>
    <div class="mb-4">
        <textarea
            cols="30"
            rows="7"
            name="{{$name}}"
            class="w-full px-4 py-2 rounded focus:outline-none {{ $errors->has($name) ? 'border-2 border-red-500' : 'border border-gray-300' }}"
            placeholder="{{$placeholder}}"
        >{{old($val)}}</textarea>
        @error($name)
        <p class="text-red-600 mt-2 text-sm">{{$message}}</p>
        @enderror
    </div>

@else
    <label class="block text-gray-700" for="{{$name}}">{{$label}}</label>
    <div class="mb-4">
        <input
            class="w-full px-4 py-2 rounded focus:outline-none {{ $errors->has($name) ? 'border-2 border-red-500' : 'border border-gray-300' }}"
            type="{{$type}}"
            name="{{$name}}"
            placeholder="{{$placeholder}}"
            {{$req ? 'required' : ''}}
            value="{{old($val)}}"
        />
        @error($name)
        <p class="text-red-600 mt-2 text-sm">{{$message}}</p>
        @enderror
    </div>

@endif
