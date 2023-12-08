<div class="btn-group">
    @if(! isset($right) )
    <button class="btn btn-primary active" data-bs-toggle="tooltip" data-bs-title="Total">
        {{ $total }}
    </button>
    @endif

    <a class="{{ $attributes->get('class', 'btn btn-primary') }}" href="{{ $route }}">
        @if( $slot->isEmpty() )
        <b>+</b>

        @else
        {!! $slot !!}

        @endif
    </a>

    @isset( $right )
    <button class="btn btn-primary active" data-bs-toggle="tooltip" data-bs-title="Total">
        {{ $total }}
    </button>
    @endisset
</div>
