<?php $default_divider = "url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"; ?>

<div style="--bs-breadcrumb-divider: {!! $attributes->get('divider', $default_divider) !!};" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($attributes->get('items') as $text => $url)
        <li class="breadcrumb-item">
            @if( is_string($text) )
            <a href="{{ $url }}" class="text-decoration-none">{!! $text !!}</a>
            
            @else
            <span>{!! $text = $url !!}</span>

            @endif
        </li>
        @endforeach
    </ol>
</div>
