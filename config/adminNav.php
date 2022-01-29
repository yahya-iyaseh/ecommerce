<?php




return [
    'dashboard' => [
        'title' => 'Dashboard',
        'route' => '/dashboard',
        'route.active' => 'dashboard',
        'icon' => 'nav-icon fas fa-th',
        'new' => false,
    ],
    'Categories' => [
        'title' => 'Categories',
        'route' => '/dashboard/categories',
        'route.active' => 'dashboard.categories.*',
        'icon' => 'nav-icon fas fa-th',
        'new' => false,
    ],
    'Products' => [
        'title' => 'Products',
        'route' => '/dashboard/products',
        'route.active' => 'dashboard.products.*',
        'icon' => 'nav-icon fas fa-th',
        'new' => false,
    ],
    'Orders' => [
        'title' => 'Dashboard4',
        'route' => '/orders',
        'route.active' => 'dashboard.order.*',
        'icon' => 'nav-icon fas fa-th',
        'new' => true,
    ],



];
