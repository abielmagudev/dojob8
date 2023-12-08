<div class="btn-group">
    @if(! isset($right) )
    <span class="{{ $attributes->get('total-class', 'btn btn-primary active') }}" data-bs-toggle="tooltip" data-bs-title="Total">
        {{ $total }}
    </span>
    @endif

    <a class="{{ $attributes->get('class', 'btn btn-primary') }}" href="{{ $route }}">
        @if( $slot->isEmpty() )
        <b>+</b>

        @else
        {!! $slot !!}

        @endif
    </a>

    @isset( $right )
    <span class="{{ $attributes->get('total-class', 'btn btn-primary active') }}" data-bs-toggle="tooltip" data-bs-title="Total">
        {{ $total }}
    </span>
    @endisset
</div>
