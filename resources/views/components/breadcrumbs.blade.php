<?php $default_divider = "url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"; ?>
<nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: {!! $attributes->get('divider', $default_divider) !!};">
    <ol class="breadcrumb text-secondary m-0">
        @foreach($attributes->get('list', []) as $breadcrumb => $route)
        <li class="breadcrumb-item">
            <small>
                @if(! empty($route) )
                <a href="{{ $route }}" class="text-decoration-none">{{ $breadcrumb  }}</a>
                
                @else
                <span>{{ $breadcrumb  }}</span>

                @endif
            </small>
        </li>
        @endforeach
    </ol>
</nav>
