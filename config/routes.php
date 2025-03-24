<?php

use \myfrm\Router;
use \myfrm\middleware\Guest;

require '../vendor/myfrm/core/middleware/Auth.php';

const MIDDLEWARE_ROUTES = [
    'auth' => \myfrm\middleware\Auth::class,
    'guest' => \myfrm\middleware\Guest::class,
];

/** @var \myfrm\Router $router */

// Reviews
$router->get('reviews', 'reviews/index.php')->only('auth');
$router->get('reviews/create', 'reviews/create.php');
$router->get('reviews/(?P<slug>[a-z0-9-]+)', 'reviews/snow.php');
$router->post('reviews', 'reviews/store.php');
$router->delete('reviews', 'reviews/destroy.php');

// User
$router->add('register', 'users/register.php', ['GET', 'POST']);
$router->add('login', 'users/login.php', ['GET', 'POST']);
$router->get('logout', 'users/logout.php')->only('auth');


// Home
$router->get('home', 'home.php');

