<a class="btn btn-primary margin-bottom-1 mb-1 float-right {{ $class }}" id="{{ $id }}" 
    @if ($isPopup)
        onclick="window.open('{{$href}}', '_blank', 'location=yes,height=800,width=800,scrollbars=yes,status=yes');"
    @else
        href="{{$href}}" 
    @endif
    name="{{ $name }}" type="{{ $type }}" {{$attrs}}>
    {!! $text !!}
</a>