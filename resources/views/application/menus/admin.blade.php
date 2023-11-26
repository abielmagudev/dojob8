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
    'Inspections' => [
        'route' => route('inspections.index'),
        'active' => request()->routeIs('inspections.*') || request()->routeIs('inspectors.*'),
    ],
    'Staff' => [
        'route' => route('members.index'),
        'active' => request()->routeIs('members.*') || request()->routeIs('crews.*'),
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
    'History' => [
        'route' => route('history.index'),
        'active' => request()->routeIs('history.*'),
    ],
];

?>
@foreach($items as $name => $props)
<li class="nav-item small">
    <a class="nav-link {{ $props['active'] ? 'active' : '' }}" href="{{ $props['route'] }}">{{ $name }}</a>
</li>
@endforeach
