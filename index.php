<?php

const BASE_PATH = __DIR__ . '/./';

session_start();

require_once BASE_PATH . 'app/Core/functions.php';
require_once base_path('app/Core/Router.php'); 
require_once base_path('app/Controllers/ProductController.php'); 
require_once base_path('app/Controllers/UserController.php');

$uri = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

// Start routing
$router = new Router();

// Authentication routes
$router->get('/', 'UserController@loginPage')->only('guest'); 
$router->get('/login', 'UserController@loginPage')->only('guest'); 
$router->post('/login', 'UserController@login')->only('guest'); 
$router->get('/register', 'UserController@registerPage')->only('guest'); 
$router->post('/register', 'UserController@register')->only('guest'); 
$router->delete('/logout', 'UserController@logout')->only('auth'); 

// Products routes
$router->get('/products', 'ProductController@index')->only('auth'); 
$router->get('/products/create', 'ProductController@create')->only('auth');
$router->post('/products/store', 'ProductController@store')->only('auth');
$router->get('/products/edit', 'ProductController@edit')->only('auth'); 
$router->put('/products/update', 'ProductController@update')->only('auth');
$router->delete('/products/delete', 'ProductController@delete')->only('auth');

// Route the request
$router->route($uri, $method);

Session::unflash();