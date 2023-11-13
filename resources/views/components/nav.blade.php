<ul class="nav {{ $attributes->get('class', '') }} {{ $attributes->has('vertical') ? 'flex-column' : 'align-items-center' }}">
    {!! $slot !!}
</ul>
