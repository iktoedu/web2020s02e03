<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$route = new Route('/', [
    '_controller' => ['App\\Controller\\IndexController', 'indexAction'],
]);
$routes->add('index', $route);
$route = new Route('/login', [
    '_controller' => ['App\\Controller\\LoginController', 'loginAction'],
    '_public' => TRUE,
]);
$routes->add('login', $route);
$route = new Route('/add', [
    '_controller' => ['App\\Controller\\CrudController', 'addAction'],
]);
$routes->add('add', $route);

return $routes;
