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
    'Calendar' => [
        'permissions' => [
            'see-assessments',
            'see-work-orders',
            'see-inspections',
            'see-payments',
        ],
        'menu' => [
            'Assessments' => [
                'active' => 'assessments.*',
                'icon' => '<i class="bi bi-clipboard-pulse"></i>',
                'permission' => 'see-assessments',
                'route' => 'assessments.index',
            ],
            'Work orders' => [
                'active' => 'work-orders.*',
                'icon' => '<i class="bi bi-clipboard"></i>',
                'permission' => 'see-work-orders',
                'route' => 'work-orders.index',
            ],
            'Inspections' => [
                'active' => 'inspections.*',
                'icon' => '<i class="bi bi-clipboard-check"></i>',
                'permission' => 'see-inspections',
                'route' => 'inspections.index',
            ], 
            'Payments' => [
                'active' => 'payments.*',
                'icon' => '<i class="bi bi-cash-coin"></i>',
                'permission' => 'see-payments',
                'route' => 'payments.index',
            ],
        ],
    ],
    'Staff' => [
        'permissions' => [
            'see-crews',
            'see-members',
        ],
        'menu' => [
            'Crews' => [
                'active' => 'crews.*',
                'icon' => '<i class="bi bi-people"></i>',
                'permission' => 'see-crews',
                'route' => 'crews.index',
            ],
            'Members' => [
                'active' => 'members.*',
                'icon' => '<i class="bi bi-person"></i>',
                'permission' => 'see-members',
                'route' => 'members.index',
            ],
        ],
    ],
    'Tools' => [
        'permissions' => [
            'see-jobs',
            'see-products',
            'see-extensions',
        ],
        'menu' => [
            'Jobs' => [
                'active' => 'jobs.*',
                'icon' => '<i class="bi bi-wrench-adjustable-circle"></i>',
                'permission' => 'see-jobs',
                'route' => 'jobs.index',
            ],
            'Products' => [
                'active' => 'products.*',
                'icon' => '<i class="bi bi-boxes"></i>',
                'permission' => 'see-products',
                'route' => 'products.index',
            ],
            'Extensions' => [
                'active' => 'extensions.*',
                'icon' => '<i class="bi bi-plug"></i>',
                'permission' => 'see-extensions',
                'route' => 'extensions.index',
            ],
        ],
    ],
    'Partners' => [
        'permissions' => [
            'see-clients',
            'see-contractors',
            'see-agencies',
        ],
        'menu' => [
            'Clients' => [
                'active' => 'clients.*',
                'icon' => '<i class="bi bi-book"></i>',
                'permission' => 'see-clients',
                'route' => 'clients.index',
            ],
            'Contractors' => [
                'active' => 'contractors.*',
                'icon' => '<i class="bi bi-bookmark-star"></i>',
                'permission' => 'see-contractors',
                'route' => 'contractors.index',
            ],
            'Agencies' => [
                'active' => 'agencies.*',
                'icon' => '<i class="bi bi-house-check"></i>',
                'permission' => 'see-agencies',
                'route' => 'agencies.index',
            ],
        ],
    ],
    'Application' => [
        'permissions' => [
            'see-users',
            'edit-history',
            'edit-settings',
        ],
        'menu' => [      
            'Users' => [
                'active' => 'users.*',
                'icon' => '<i class="bi bi-person-workspace"></i>',
                'permission' => 'see-users',
                'route' => 'users.index',
            ],
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
