<div class="row mb-3 {{ $attributes->get('class', '') }}">
    <div class="col-md col-md-3 col-xl-2 {{ $attributes->get('label-class', '') }}">
        {!! $label !!}
    </div>
    <div class="col-md col-md-9 col-xl-10 {{ $attributes->get('slot-class', '') }}">
        {!! $slot !!}
    </div>
</div>
