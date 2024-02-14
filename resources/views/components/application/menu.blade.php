<?php

return [
    'Home' => [
        'Dashboard' => [
            'active' => request()->routeIs('dashboard.*'),
            'icon' => '<i class="bi bi-bar-chart-line"></i>',
            'permission' => true,
            'route' => route('dashboard.index'),
        ],
    ],
    'Work orders' => [
        'Work orders' => [
            'active' => request()->routeIs('work-orders.*'),
            'icon' => '<i class="bi bi-clipboard"></i>',
            'permission' => true,
            'route' => route('work-orders.index'),
        ],
        'Payments' => [
            'active' => request()->routeIs('payments.*'),
            'icon' => '<i class="bi bi-cash-coin"></i>',
            'route' => route('payments.index'),
            'permission' => true,
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
        'Clients' => [
            'active' => request()->routeIs('clients.*'),
            'icon' => '<i class="bi bi-book"></i>',
            'permission' => true,
            'route' => route('clients.index'),
        ],
    ],
    'Inspections' => [
        'Inspections' => [
            'active' => request()->routeIs('inspections.*'),
            'icon' => '<i class="bi bi-clipboard-check"></i>',
            'route' => route('inspections.index'),
            'permission' => true,
        ], 
        'Agencies' => [
            'active' => request()->routeIs('agencies.*'),
            'icon' => '<i class="bi bi-award"></i>',
            'route' => route('agencies.index'),
            'permission' => true,
        ],
    ],
    'Staff' => [
        'Members' => [
            'active' => request()->routeIs('members.*'),
            'icon' => '<i class="bi bi-person"></i>',
            'permission' => true,
            'route' => route('members.index'),
        ],
        'Crews' => [
            'active' => request()->routeIs('crews.*'),
            'icon' => '<i class="bi bi-people"></i>',
            'permission' => true,
            'route' => route('crews.index'),
        ],
        'Contractors' => [
            'active' => request()->routeIs('contractors.*'),
            'icon' => '<i class="bi bi-bookmark-star"></i>',
            'permission' => true,
            'route' => route('contractors.index'),
        ],
        'Users' => [
            'active' => request()->routeIs('users.*'),
            'icon' => '<i class="bi bi-person-workspace"></i>',
            'permission' => true,
            'route' => route('users.index'),
        ],
    ],
    'Application' => [
        'History' => [
            'active' => request()->routeIs('history.*'),
            'icon' => '<i class="bi bi-clock-history"></i>',
            'permission' => true,
            'route' => route('history.index'),
        ],
        'Configuration' => [
            'active' => request()->routeIs('configuration.*'),
            'icon' => '<i class="bi bi-gear"></i>',
            'permission' => true,
            'route' => route('configuration.index'),
        ],
    ],
];
