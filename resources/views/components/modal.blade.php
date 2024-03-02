<div class="modal fade" tabindex="-1" id="{{ $attributes->get('id') }}" aria-labelledby="{{ $attributes->get('id') }}Label" @if( $attributes->has('static') ) data-bs-backdrop="static" data-bs-keyboard="false" @endif aria-hidden="true">
    <div class="modal-dialog {{ $attributes->get('dialog-class') }}">
        <div class="modal-content">

            {{-- Header --}}
            <div class="modal-header align-items-start border-0 {{ $attributes->get('header-class', '') }}">
                <div>
                    <h1 class="modal-title fs-5" id="{{ $attributes->get('id') }}Label">{{ $attributes->get('title') ?? $title ?? '' }}</h1>
                    <small>{{ $attributes->get('subtitle', '') }}</small>
                </div>
                @if( $attributes->has('header-close') )     
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>

            {{-- Body --}}
            <div class="modal-body {{ $attributes->get('body-class', '') }}">
                {!! $slot !!}

                @if( stripos($attributes->get('dialog-class'), 'modal-dialog-scrollable') !== false )                   
                <div class="position-sticky bg-dark bg-opacity-10 text-center py-1 px-3" style="z-index:8;bottom:-1rem">
                    <b class="text-secondary">
                        <small>Scroll up or down</small>
                    </b>
                </div>
                @endif
            </div>

            {{-- Footer --}}
            @if( isset($footer) )              
            <div class="modal-footer {{ $attributes->get('footer-class', '') }}">
                @isset($footer)
                {!! $footer !!} 
                @endisset
            </div>
            @endif

        </div>
    </div>
</div>
