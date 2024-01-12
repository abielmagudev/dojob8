<a href="{{ workOrderUrlGenerator('unfinished', $parameters) }}" class="{{ isset($class) ? $class : 'btn btn-warning btn-sm' }}">
    <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
</a>
