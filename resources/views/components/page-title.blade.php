@if( $attributes->has('pretitle') )
<small>{!! $pretitle !!}</small>
@endif

<h1 class="mb-1">{!! $slot !!}</h1>

@if( isset($subtitle) )
<div class="text-secondary-emphasis mb-3">{!! $subtitle !!}</div>
@endif
