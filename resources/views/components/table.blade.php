<div class="table-responsive">
    <table class="table table-hover {{ $attributes->get('class', '') }}">
        
        @isset( $caption )
        <caption>{{ $caption }}</caption>
        @endisset

        @isset($thead)
        <thead class="{{ $attributes->get('thead-class', '') }}">
            {!! $thead !!}
        </thead>
        @endisset

        <tbody class="{{ $attributes->get('tbody-class', '') }}">
            {!! $slot !!}
        </tbody>
        
    </table>
</div>
