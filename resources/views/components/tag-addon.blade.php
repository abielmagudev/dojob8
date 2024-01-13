<div class="d-inline-block overflow-hidden {{ $attributes->has('bordered') ? 'border' : '' }} {{ $attributes->has('rounded') ? 'rounded' : '' }} {{ $attributes->get('class', '') }}">
    <div class="d-flex align-items-center justify-content-between">
        <small class="px-2 {{ $attributes->get('addon-class', '') }}">{{ $attributes->get('addon') }}</small>
        <small class="px-2 {{ $attributes->get('value-class', '') }}">{!! $attributes->get('value') ?? $slot ?? '' !!}</small>
    </div>
</div>
