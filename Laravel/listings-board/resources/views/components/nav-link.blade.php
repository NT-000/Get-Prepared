@props(['url' => '/','active' => false, 'icon' => null, 'isJobListing' => false, 'display' => ''])

<a {{$attributes}} href="{{$url}}"
   class="{{$display}} {{$isJobListing ? 'no-underline' : ''}} {{$isJobListing ? '' : 'hover:underline'}} py-2 {{$active ? 'text-yellow-500 font-bold' : ''}}">
    @if($icon)
        <i class="fa fa-{{$icon}} mr-1"></i>
    @endif
    {{$slot}}
</a>
