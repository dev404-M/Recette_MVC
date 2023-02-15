<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Plat\Router($_SERVER["REQUEST_URI"]);
$router->get('/', "PlatController@index");

$router->get('/login/', "UserController@showLogin");
$router->get('/register/', "UserController@showRegister");
$router->get('/logout/', "UserController@logout");
$router->get('/dashboard/', "PlatController@showAll");
$router->get('/filters/', "PlatController@showFilters");
$router->get('/showcart/', "PlatController@showCart");
$router->post('/login/', "UserController@login");
$router->post('/register/', "UserController@register");
$router->post('/filtered/', "PlatController@showFiltered");
$router->post('/addToCart/', "PlatController@addToCart");
$router->post('/actionCart/', "PlatController@actionCart");



$router->run();