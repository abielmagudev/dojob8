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
        'active' => request()->routeIs('jobs.*') || request()->routeIs('extensions.*'),
        'dropdown' => [
            'Jobs' => route('jobs.index'),
            'Extensions' => route('extensions.index'),
        ],
    ],
    'Inspections' => [
        'route' => route('inspections.index'),
        'active' => request()->routeIs('inspections.*') || request()->routeIs('inspectors.*'),
        'dropdown' => [
            'Inspections' => route('inspections.index'),
            'Inspectors' => route('inspectors.index')
        ],
    ],
    'Staff' => [
        'route' => route('members.index'),
        'active' => request()->routeIs('members.*') || request()->routeIs('crews.*'),
        'dropdown' => [
            'Members' => route('members.index'),
            'Crews' => route('crews.index'),
        ],
    ],
    'Contractors' => [
        'route' => route('contractors.index'),
        'active' => request()->routeIs('contractors.*'),
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
@isset( $props['dropdown'] )
<li class="nav-item small dropdown">
    
    <a class="nav-link {{ $props['active'] ? 'active' : '' }} " data-bs-toggle="dropdown" href="{{ $props['route'] }}">
        <span class="align-middle me-1">{{ $name }}</span>
        <span class="align-middle">
            <i class="bi bi-caret-down-fill"></i>
        </span>
    </a>
    <ul class="dropdown-menu border-0 shadow">
        @foreach($props['dropdown'] as $subname => $subroute)
        <li>
            <a class="dropdown-item" href="{{ $subroute }}">{{ $subname }}</a>
        </li>
        @endforeach
    </ul>
</li>

@else
<li class="nav-item small">
    <a class="nav-link {{ $props['active'] ? 'active' : '' }}" href="{{ $props['route'] }}">{{ $name }}</a>
</li>

@endisset
@endforeach
