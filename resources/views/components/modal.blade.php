<div class="modal fade" id="{{ $attributes->get('id') }}" tabindex="-1" aria-labelledby="{{ $attributes->get('id') }}Label" @if( $attributes->has('static') ) data-bs-backdrop="static" data-bs-keyboard="false" @endif aria-hidden="true">
    <div class="modal-dialog {{ $attributes->get('dialog-class') }}">
        <div class="modal-content">

            <div class="modal-header border-0 {{ $attributes->get('header-class', '') }}">
                <h1 class="modal-title fs-5" id="{{ $attributes->get('id') }}Label">{{ $attributes->get('title') ?? $title ?? '' }}</h1>
                @if( $attributes->has('header-close') )     
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>

            <div class="modal-body {{ $attributes->get('body-class', '') }}">
                {!! $slot !!}
            </div>

            @if( isset($footer) || $attributes->has('footer-close')  )              
            <div class="modal-footer {{ $attributes->get('footer-class', '') }}">
                @isset($footer)
                {!! $footer !!} 
                @endisset

                @if( $attributes->has('footer-close') )
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
