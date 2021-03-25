<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$routes = require_once __DIR__ . '/../config/routes.php';

$request_context = new \Symfony\Component\Routing\RequestContext();

$matcher = new \Symfony\Component\Routing\Matcher\UrlMatcher($routes, $request_context);
try {
    $parameters = $matcher->matchRequest($request);
}
catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
    $parameters = [
        '_controller' => ['App\\Controller\\NotFoundController', 'indexAction'],
    ];
}

$parameters['_controller'][0] = new $parameters['_controller'][0];
/** @var \Symfony\Component\HttpFoundation\Response $result */
$result = call_user_func_array($parameters['_controller'], []);

$result->send();
