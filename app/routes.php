<?php

/**
 * Set up the routes for the application:
 *   :id -> indicates a numeric key
 *   :opt -> indicates an optional key
 * (see dynamis/core/router.php for more detail)
 */
router::setRoutes( array(
    ''                        => 'posts#index',
    'login'                   => 'users#login',
    'logout'                  => 'users#logout',
    'blog'                    => 'posts#index',
    'blog/:opt'               => 'posts#index',
    'blog/view/:opt'          => 'posts#view',
    'page/:id'                => 'pages#view'
) );

// Uncomment to use SSL on selected routes
/*router::setSecureRoutes(array(
    'users'                 => 'all',
    'pages'                 => array('add','edit','index','delete'),
    'posts'                 => array('add','edit','manage','delete'),
));*/
