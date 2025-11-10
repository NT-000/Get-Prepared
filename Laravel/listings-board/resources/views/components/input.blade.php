@props(['type' => '', 'name' => '', 'placeholder' => '', 'req' => false, 'key' => '', 'val' => ''])

<input class="p-1 border-3 border-solid border-black rounded focus:backdrop-brightness-110" type="{{$type}}"
       name="{{$name}}"
       placeholder="{{$placeholder}}" {{$req ? 'required' : ''}} value="{{old ($val)}}"/>
@error("$key")
<p class="text-red-600 mt-2 text-sm">{{$message}}</p>
@enderror
