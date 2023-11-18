<div class="row mb-3 {{ $attributes->get('class', '') }}">
    <div class="col-md {{ $attributes->get('label-class', '') }}">
        {!! $label !!}
    </div>
    <div class="col-md col-md-9 col-lg-10 {{ $attributes->get('slot-class', '') }}">
        {!! $slot !!}
    </div>
</div>
