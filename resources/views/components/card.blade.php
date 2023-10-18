<div class="card shadow-sm border-0">

    @if( isset($title) || isset($options) )
    <div class="card-header border-0 bg-white py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="lead">{{ $title ?? '' }}</div>
                <div class="text-secondary">{{ $subtitle ?? '' }}</div>
            </div>
            <div>
                {!! $options ?? '' !!}
            </div>
        </div>
    </div>
    @endif

    @if( $attributes->has('image-top') )
    <img src="{{ $attributes->get('image-top') }}" alt="{{ $attributes->get('image-alt', '') }}" class="card-img-top">
    @endif

    <div class="card-body">{!! $slot !!}</div>

    @isset($footer)
    <div class="card-footer">
        {!! $footer !!}
    </div>
    @endisset

</div>
