<div class="row mb-3 {{ $attributes->get('class', '') }}">
    <div class="col-md col-md-4 col-lg-3 col-xl-2 {{ $attributes->get('label-class', '') }}">
        {!! $label !!}
    </div>
    <div class="col-md col-md-8 col-lg-9 col-xl-10 {{ $attributes->get('slot-class', '') }}">
        {!! $slot !!}
    </div>
</div>
