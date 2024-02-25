<?php 

return [
    'Home' => [
        'Dashboard' => [
            'active' => 'dashboard.*',
            'icon' => '<i class="bi bi-bar-chart-line"></i>',
            'permission' => true,
            'route' => 'dashboard.index',
        ],
    ],
    'Work orders' => [
        'Work orders' => [
            'active' => 'work-orders.*',
            'icon' => '<i class="bi bi-clipboard"></i>',
            'permission' => true,
            'route' => 'work-orders.index',
        ],
        'Jobs' => [
            'active' => 'jobs.*',
            'icon' => '<i class="bi bi-nut"></i>',
            'permission' => true,
            'route' => 'jobs.index',
        ],
        'Extensions' => [
            'active' => 'extensions.*',
            'icon' => '<i class="bi bi-plug"></i>',
            'permission' => true,
            'route' => 'extensions.index',
        ],
        'Clients' => [
            'active' => 'clients.*',
            'icon' => '<i class="bi bi-book"></i>',
            'permission' => true,
            'route' => 'clients.index',
        ],
        'Payments' => [
            'active' => 'payments.*',
            'icon' => '<i class="bi bi-cash-coin"></i>',
            'permission' => true,
            'route' => 'payments.index',
        ],
    ],
    'Inspections' => [
        'Inspections' => [
            'active' => 'inspections.*',
            'icon' => '<i class="bi bi-clipboard-check"></i>',
            'permission' => true,
            'route' => 'inspections.index',
        ], 
        'Agencies' => [
            'active' => 'agencies.*',
            'icon' => '<i class="bi bi-award"></i>',
            'permission' => true,
            'route' => 'agencies.index',
        ],
    ],
    'Staff' => [
        'Members' => [
            'active' => 'members.*',
            'icon' => '<i class="bi bi-person"></i>',
            'permission' => true,
            'route' => 'members.index',
        ],
        'Crews' => [
            'active' => 'crews.*',
            'icon' => '<i class="bi bi-people"></i>',
            'permission' => true,
            'route' => 'crews.index',
        ],
        'Contractors' => [
            'active' => 'contractors.*',
            'icon' => '<i class="bi bi-bookmark-star"></i>',
            'permission' => true,
            'route' => 'contractors.index',
        ],
        'Users' => [
            'active' => 'users.*',
            'icon' => '<i class="bi bi-person-workspace"></i>',
            'permission' => true,
            'route' => 'users.index',
        ],
    ],
    'Application' => [
        'History' => [
            'active' => 'history.*',
            'icon' => '<i class="bi bi-clock-history"></i>',
            'permission' => true,
            'route' => 'history.index',
        ],
        'Settings' => [
            'active' => 'settings.*',
            'icon' => '<i class="bi bi-gear"></i>',
            'permission' => true,
            'route' => 'settings.index',
        ],
    ],
];