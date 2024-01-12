<?php

return [
    'Dashboard' => [
        'active' => request()->routeIs('dashboard.*'),
        'icon' => '<i class="bi bi-bar-chart-line"></i>',
        'permission' => true,
        'route' => route('dashboard.index'),
    ],
    'Work orders' => [
        'active' => request()->routeIs('work-orders.*'),
        'icon' => '<i class="bi bi-list-task"></i>',
        'permission' => true,
        'route' => route('work-orders.index'),
    ],
    'Jobs' => [
        'active' => request()->routeIs('jobs.*'),
        'icon' => '<i class="bi bi-nut"></i>',
        'permission' => true,
        'route' => route('jobs.index'),
    ],
    'Extensions' => [
        'active' => request()->routeIs('extensions.*'),
        'icon' => '<i class="bi bi-plug"></i>',
        'permission' => true,
        'route' => route('extensions.index')
    ],
    'Inspections' => [
        'active' => request()->routeIs('inspections.*'),
        'icon' => '<i class="bi bi-clipboard-check"></i>',
        'route' => route('inspections.index'),
        'permission' => true,
    ],
    'Inspectors' => [
        'active' => request()->routeIs('inspectors.*'),
        'icon' => '<i class="bi bi-eyeglasses"></i>',
        'permission' => true,
        'route' => route('inspectors.index'),
    ],
    'Staff' => [
        'active' => request()->routeIs('members.*'),
        'icon' => '<i class="bi bi-people"></i>',
        'permission' => true,
        'route' => route('members.index'),
    ],
    'Crews' => [
        'active' => request()->routeIs('crews.*'),
        'icon' => '<i class="bi bi-bounding-box-circles"></i>',
        'permission' => true,
        'route' => route('crews.index'),
    ],
    'Contractors' => [
        'active' => request()->routeIs('contractors.*'),
        'icon' => '<i class="bi bi-c-circle"></i>',
        'permission' => true,
        'route' => route('contractors.index'),
    ],
    'Clients' => [
        'active' => request()->routeIs('clients.*'),
        'icon' => '<i class="bi bi-book"></i>',
        'permission' => true,
        'route' => route('clients.index'),
    ],
    'Users' => [
        'active' => request()->routeIs('users.*'),
        'icon' => '<i class="bi bi-person"></i>',
        'permission' => true,
        'route' => route('users.index'),
    ],
    'History' => [
        'active' => request()->routeIs('history.*'),
        'icon' => '<i class="bi bi-clock-history"></i>',
        'permission' => true,
        'route' => route('history.index'),
    ],
];