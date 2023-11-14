<?php

$items = [
    'Dashboard' => [
        'route' => '#dashboard',
        'active' => false,
    ],
    'Orders' => [
        'route' => route('orders.index'),
        'active' => request()->routeIs('orders.*'),
    ],
    'Jobs' => [
        'route' => route('jobs.index'),
        'active' => request()->routeIs('jobs.*') || request()->routeIs('extensions.*'),
    ],
    'Staff' => [
        'route' => '#employees-crews',
        'active' => false,
    ],
    'Intermediaries' => [
        'route' => '#intermediaries',
        'active' => false,
    ],
    'Users' => [
        'route' => '#users-admins-coordinators-operators-intermediaries-guests',
        'active' => false,
    ],
    'Clients' => [
        'route' => route('clients.index'),
        'active' => request()->routeIs('clients.*'),
    ],
];

?>
@foreach($items as $name => $props)
<li class="nav-item small">
    <a class="nav-link {{ $props['active'] ? 'active' : '' }}" href="{{ $props['route'] }}">{{ $name }}</a>
</li>
@endforeach
