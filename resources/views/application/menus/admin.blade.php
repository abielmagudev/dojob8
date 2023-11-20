<?php

$items = [
    'Dashboard' => [
        'route' => route('dashboard.index'),
        'active' => request()->routeIs('dashboard.*'),
    ],
    'Orders' => [
        'route' => route('orders.index'),
        'active' => request()->routeIs('orders.*'),
    ],
    'Jobs' => [
        'route' => route('jobs.index'),
        'active' => request()->routeIs('jobs.*') || request()->routeIs('extensions.*'),
    ],
    'Inspectors' => [
        'route' => route('inspectors.index'),
        'active' => request()->routeIs('inspectors.*'),
    ],
    'Staff' => [
        'route' => '#employees-crews',
        'active' => false,
    ],
    'Intermediaries' => [
        'route' => route('intermediaries.index'),
        'active' => request()->routeIs('intermediaries.*'),
    ],
    'Clients' => [
        'route' => route('clients.index'),
        'active' => request()->routeIs('clients.*'),
    ],
    'Users' => [
        'route' => route('users.index'),
        'active' => request()->routeIs('users.*'),
    ],
];

?>
@foreach($items as $name => $props)
<li class="nav-item small">
    <a class="nav-link {{ $props['active'] ? 'active' : '' }}" href="{{ $props['route'] }}">{{ $name }}</a>
</li>
@endforeach
