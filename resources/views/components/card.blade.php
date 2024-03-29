<div class="card shadow-sm border-0 {{ $attributes->get('class', '') }}" style="{{ $attributes->get('style', '') }}">

    @if( isset($title) || isset($options) || isset($dropoptions) )
    <div class="card-header rounded">
        <div class="d-flex justify-content-between align-items-center">

            {{-- Left --}}
            @isset( $title )             
            <div class="col-sm">
                <div class="mb-1">
                    @if( $attributes->has('title') )
                    <b>{{ $attributes->get('title') }}</b>
    
                    @else
                    {!! $title !!}
    
                    @endif
                </div>

                @isset($subtitle)         
                <small class="{{ $attributes->get('subtitle-class', '') }}">{{ $subtitle }}</small>
                @endisset
            </div>
            @endisset

            {{-- Right --}}
            @if( isset($options) || isset($dropoptions) )  
            <div class="col-sm">
                <div class="d-flex align-items-center justify-content-end">

                    @isset($options)       
                    <div class="{{ $attributes->get('options-class', '') }}">
                        {!! $options !!}
                    </div>
                    @endisset
    
                    @isset($dropoptions)              
                    <div class="{{ $attributes->get('dropoptions-class', '') }} ms-1">
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
