<?php


return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'active' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'badge' => 'New'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'active' => 'dashboard.categories.*',
        'title' => 'Categories'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.products.index',
        'active' => 'dashboard.products.*',
        'title' => 'Proudcts'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'active' => 'dashboard.order.*',
        'title' => 'Orders'
    ],
];

?>
