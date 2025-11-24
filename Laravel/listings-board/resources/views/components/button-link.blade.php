@props(['url' => '/', 'icon' => null, 'bgClass' => 'bg-yellow-500', 'hoverClass' => 'hover:bg-yellow-600', 'textClass' => 'text-black'])

<a href="{{url($url)}}" class="font-bold px-4 py-2 rounded-md {{$bgClass}} {{$hoverClass}} {{$textClass}}">
    @if($icon)
        <i class="fa fa-{{$icon}} mr-1"></i>
    @endif
    {{$slot}}
</a>
