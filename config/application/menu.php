<?php 

return [
    'Home' => [
        'permissions' => null,
        'menu' => [
            'Dashboard' => [
                'active' => 'dashboard.*',
                'icon' => '<i class="bi bi-bar-chart-line"></i>',
                'permission' => null,
                'route' => 'dashboard.index',
            ],
        ],
    ],
    'Work orders' => [
        'permissions' => [
            'see-work-orders',
            'see-jobs',
            'see-extensions',
            'see-clients',
            'see-payments',
        ],
        'menu' => [
            'Work orders' => [
                'active' => 'work-orders.*',
                'icon' => '<i class="bi bi-clipboard"></i>',
                'permission' => 'see-work-orders',
                'route' => 'work-orders.index',
            ],
            'Jobs' => [
                'active' => 'jobs.*',
                'icon' => '<i class="bi bi-nut"></i>',
                'permission' => 'see-jobs',
                'route' => 'jobs.index',
            ],
            'Extensions' => [
                'active' => 'extensions.*',
                'icon' => '<i class="bi bi-plug"></i>',
                'permission' => 'see-extensions',
                'route' => 'extensions.index',
            ],
            'Clients' => [
                'active' => 'clients.*',
                'icon' => '<i class="bi bi-book"></i>',
                'permission' => 'see-clients',
                'route' => 'clients.index',
            ],
            'Payments' => [
                'active' => 'payments.*',
                'icon' => '<i class="bi bi-cash-coin"></i>',
                'permission' => 'see-payments',
                'route' => 'payments.index',
            ],
        ],
    ],
    'Inspections' => [
        'permissions' => [
            'see-inspections',
            'see-agencies',
        ],
        'menu' => [
            'Inspections' => [
                'active' => 'inspections.*',
                'icon' => '<i class="bi bi-clipboard-check"></i>',
                'permission' => 'see-inspections',
                'route' => 'inspections.index',
            ], 
            'Agencies' => [
                'active' => 'agencies.*',
                'icon' => '<i class="bi bi-award"></i>',
                'permission' => 'see-agencies',
                'route' => 'agencies.index',
            ],
        ],
    ],
    'Staff' => [
        'permissions' => [
            'see-members',
            'see-crews',
            'see-contractors',
            'see-users',
        ],
        'menu' => [
            'Members' => [
                'active' => 'members.*',
                'icon' => '<i class="bi bi-person"></i>',
                'permission' => 'see-members',
                'route' => 'members.index',
            ],
            'Crews' => [
                'active' => 'crews.*',
                'icon' => '<i class="bi bi-people"></i>',
                'permission' => 'see-crews',
                'route' => 'crews.index',
            ],
            'Contractors' => [
                'active' => 'contractors.*',
                'icon' => '<i class="bi bi-bookmark-star"></i>',
                'permission' => 'see-contractors',
                'route' => 'contractors.index',
            ],
            'Users' => [
                'active' => 'users.*',
                'icon' => '<i class="bi bi-person-workspace"></i>',
                'permission' => 'see-users',
                'route' => 'users.index',
            ],
        ],
    ],
    'Application' => [
        'permissions' => [
            'see-history',
            'edit-settings',
        ],
        'menu' => [        
            'History' => [
                'active' => 'history.*',
                'icon' => '<i class="bi bi-clock-history"></i>',
                'permission' => 'see-history',
                'route' => 'history.index',
            ],
            'Settings' => [
                'active' => 'settings.*',
                'icon' => '<i class="bi bi-gear"></i>',
                'permission' => 'see-settings',
                'route' => 'settings.index',
            ],
        ]
    ],
];
