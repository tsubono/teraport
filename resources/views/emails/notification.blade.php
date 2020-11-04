{!! nl2br(e($text)) !!}

@if (!is_null($url))
<a href="{{ $url }}" target="_blank">{{ $url }}</a>
@endif
