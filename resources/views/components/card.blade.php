<div class="card shadow-sm border-0">

    @if( $attributes->has('title') || isset($title) )
    <div class="card-header">
        <span>{{ $attributes->get('title', null) ?? $title }}</span>
    </div>
    @endif

    <div class="card-body">{!! $slot !!}</div>

    @isset($footer)
    <div class="card-footer">
        {{ $footer }}
    </div>
    @endisset

</div>
