@props(['jobOptions' => ['Yes', 'No'], 'name' => '', 'label' => ''])

<label class="block text-gray-700" for="{{$label}}">{{$label}}</label>
<select
    id="job_type"
    name="job_type"
    class="w-full px-4 py-2 border rounded focus:outline-none"
>
    @foreach($jobOptions as $option)
        <option value="{{$option}}" {{ old('job_type') == $option ? 'selected' : '' }}>{{$option}}</option>
    @endforeach
</select>
