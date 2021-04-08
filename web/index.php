<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$request = Request::createFromGlobals();
$request->setSessionFactory(function () {
    $session = new Session();
    $session->start();

    return $session;
});

$routes = require_once __DIR__ . '/../config/routes.php';

$request_context = new RequestContext();
$request_context->fromRequest($request);

$matcher = new UrlMatcher($routes, $request_context);
try {
    $parameters = $matcher->matchRequest($request);
}
catch (ResourceNotFoundException $e) {
    $parameters = [
        '_controller' => ['App\\Controller\\NotFoundController', 'indexAction'],
        '_public' => TRUE,
    ];
}

if (empty($parameters['_public'])) {
    $session = $request->getSession();
    if (empty($session->get('is_logged_in'))) {
        $generator = new UrlGenerator($routes, $request_context);
        $result = new RedirectResponse($generator->generate('login'));
        $result->send();
        exit(0);
    }
}

$parameters['_controller'][0] = new $parameters['_controller'][0];
$parameters['_controller'][0]->setRoutes($routes);
/** @var Response $result */
$result = call_user_func_array($parameters['_controller'], [$request, $parameters]);

$result->send();
