@props([
    'type' => '',
    'name' => '',
    'placeholder' => '',
    'req' => false,
    'key' => '',
    'val' => '',
    'label' => '',
    'isTextarea' => false
    ])



@if($isTextarea)
    <label class="block text-gray-700" for="description">{{$label}}</label>
    <textarea
        cols="30"
        rows="7"
        name="{{$name}}"
        class="w-full px-4 py-2 border rounded focus:outline-none"
        placeholder="{{$placeholder}}"
    >
    </textarea>
    @error("$key")
    <p class="text-red-600 mt-2 text-sm">{{$message}}</p>
    @enderror
@else
    <label class="block text-gray-700" for="title">{{$label}}</label>
    <input class="p-1 border-3 border-solid border-black rounded focus:backdrop-brightness-110" type="{{$type}}"
           name="{{$name}}"
           placeholder="{{$placeholder}}" {{$req ? 'required' : ''}} value="{{old ($val)}}"/>
    @error("$key")
    <p class="text-red-600 mt-2 text-sm">{{$message}}</p>
    @enderror
@endif
