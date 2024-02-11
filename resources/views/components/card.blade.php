<div class="card shadow-sm border-0 {{ $attributes->get('class', '') }}" style="{{ $attributes->get('style', '') }}">

    @if( isset($title) || isset($options) || isset($dropoptions) )
    <?php $col_classname = $attributes->has('header-wrap') ? 'col-sm mb-3 mb-md-0' : 'col' ?>

    <div class="card-header border-bottom-0 py-3">
        <div class="row align-items-center">

            {{-- Left --}}
            @if( isset($title) )              
            <div class="{{ $col_classname }}">
                <div>
                    <div class="{{ $attributes->get('title-class', 'fw-bold') }}">
                        {!! $title !!}
                    </div>
                    <small class="{{ $attributes->get('subtitle-class', '') }}">{{ $attributes->get('subtitle', '') }}</small>
                </div>
            </div>
            @endif

            {{-- Right --}}
            @if( isset($options) || isset($dropoptions) )  
            <div class="{{ $col_classname }}">
                <div class="d-flex align-items-center justify-content-end">

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
            @endif
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
    <div class="card-footer">{!! $footer !!}</div>
    @endisset

</div>
