@props(['url' => '/', 'icon' => null, 'bgClass' => 'bg-yellow-500', 'hoverClass' => 'hover:bg-yellow-600', 'textClass' => 'text-black'])

<a href="{{$url}}" class="py-3 px-2 rounded-md {{$bgClass}} {{$hoverClass}} {{$textClass}}">
    @if($icon)
        <i class="fa fa-{{$icon}} mr-1"></i>
    @endif
    {{$slot}}
</a>
