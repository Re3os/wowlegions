@if ($paginator->hasPages())
<div class="container">
    @foreach ($elements as $element)
        @if (is_string($element))
    &nbsp;<strong>{{ $page }}</strong>&nbsp;
    @endif
    @if (is_array($element))
    @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
                &nbsp;<strong>{{ $page }}</strong>&nbsp;
            @else
                <a href="{{ $url }}" data-hasevent="1">{{ $page }}</a>&nbsp;
        @endif
    @endforeach
@endif
@endforeach
</div>
@endif