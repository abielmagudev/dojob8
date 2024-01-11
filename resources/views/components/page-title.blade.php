@if($attributes->has('pretitle'))
<small>{!! $pretitle !!}</small>
@endif

<h1 class="mb-1">{!! $slot !!}</h1>

@if($attributes->has('subtitle'))
<p class="text-secondary-emphasis">{!! $subtitle !!}</p>
@endif
