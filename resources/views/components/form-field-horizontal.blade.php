<div class="row mb-3 {{ $attributes->get('class', '') }}">
    <label for="{{ $attributes->get('for', '') }}" class="col-md col-md-3 col-xl-2 col-form-label {{ $attributes->get('label-class', '') }}">
        {!! $label !!}
    </label>
    <div class="col-md col-md-9 col-xl-10 {{ $attributes->get('slot-class', '') }}">
        {!! $slot !!}
    </div>
</div>
