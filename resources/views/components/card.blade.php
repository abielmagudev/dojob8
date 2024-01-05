<div class="card shadow-sm border-0 {{ $attributes->get('class', '') }}" style="{{ $attributes->get('style', '') }}">

    @if( isset($title) || isset($options) || isset($dropoptions) )
    <div class="card-header border-0 bg-white py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="lead">{{ $title ?? '' }}</div>
                <div class="text-secondary">{{ $attributes->get('subtitle', '') }}</div>
            </div>
            <div>
                @isset($options)       
                <div class="{{ $attributes->get('options-class', 'd-inline-block align-middle') }}">
                    {!! $options !!}
                </div>
                @endisset

                @isset($dropoptions)              
                <div class="d-inline-block align-middle">
                    <div class="dropdown dropdown-menu-end">
                        <button class="btn text-bg-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
