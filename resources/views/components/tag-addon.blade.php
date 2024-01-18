<div class="d-inline-block overflow-hidden {{ $attributes->has('bordered') ? 'border' : '' }} {{ $attributes->has('rounded') ? 'rounded' : '' }} {{ $attributes->get('class', '') }}">
    <div class="d-flex align-items-center justify-content-between">
        <small class="ps-2 pe-1 {{ $attributes->get('addon-class', '') }}">{{ $attributes->get('addon') }}</small>
        <small class="ps-1 pe-2 {{ $attributes->get('value-class', '') }}">{!! $attributes->get('value') ?? $slot ?? '' !!}</small>
    </div>
</div>
