<?php

$items = [
    'Dashboard' => [
        'route' => route('dashboard.index'),
        'active' => request()->routeIs('dashboard.*'),
    ],
    'Work orders' => [
        'route' => route('work-orders.index'),
        'active' => request()->routeIs('work-orders.*'),
    ],
    'Jobs' => [
        'route' => route('jobs.index'),
        'active' => request()->routeIs('jobs.*'),
    ],
    'Extensions' => [
        'route' => route('extensions.index'),
        'active' => request()->routeIs('extensions.*'),
    ],
    'Inspections' => [
        'route' => route('inspections.index'),
        'active' => request()->routeIs('inspections.*'),
    ],
    'Inspectors' => [
        'route' => route('inspectors.index'),
        'active' => request()->routeIs('inspectors.*'),
    ],
    'Staff' => [
        'route' => route('members.index'),
        'active' => request()->routeIs('members.*'),
    ],
    'Crews' => [
        'route' => route('crews.index'),
        'active' => request()->routeIs('crews.*'),
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
