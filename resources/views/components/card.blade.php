<div class="card shadow-sm border-0 {{ $attributes->get('class', '') }}" style="{{ $attributes->get('style', '') }}">

    @if( isset($title) || isset($custom_title) || isset($options) || isset($dropoptions) )
    <div class="card-header border-bottom-0 py-3">
        <div class="d-flex align-items-center justify-content-between">

            {{-- Left --}}
            <div>
                @isset($custom_title)
                {!! $custom_title !!}

                @else
                <b class="d-block">{{ $title ?? '' }}</b>

                @endisset
                <small>{{ $attributes->get('subtitle', '') }}</small>
            </div>

            {{-- Right --}}
            <div class="d-flex align-items-center justify-content-between">
                @isset($options)       
                <div class="{{ $attributes->get('options-class', '') }}">
                    {!! $options !!}
                </div>
                @endisset

                @isset($dropoptions)              
                <div class="{{ $attributes->get('dropoptions-class', '') }} ms-3">
                    <div class="dropdown dropdown-menu-end">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                          {!! $dropoptions !!}
                        </ul>
                      </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
    @endif

    @if( $attributes->has('image-top') )
    <img src="{{ $attributes->get('image-top') }}" alt="{{ $attributes->get('image-alt', '') }}" class="card-img-top">
    @endif

    @if( $slot->isNotEmpty() )
    <div class="card-body">{!! $slot !!}</div>
    @endif

    @isset($footer)
    <div class="card-footer">
        {!! $footer !!}
    </div>
    @endisset
    
</div>
