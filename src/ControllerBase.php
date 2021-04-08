<?php

namespace App;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class ControllerBase
{

    /**
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @var RouteCollection
     */
    private $routes;

    /**
     * @param RouteCollection $routes
     */
    public function setRoutes(RouteCollection $routes): void
    {
        $this->routes = $routes;
    }

    protected function render($template, $params) {
        if ($this->twig === NULL) {
            $loader = new FilesystemLoader(__DIR__ . '/../templates');
            $this->twig = new Environment($loader);
        }

        return $this->twig->render($template, $params);
    }

    protected function db() {
        if ($this->db === NULL) {
            $this->db = new \PDO('mysql:host=127.0.0.1;dbname=ikt_edu_web2020s02e03', 'ikt_edu_web2020s02e03', 'ikt_edu_web2020s02e03');
        }

        return $this->db;
    }

    protected function generateUrl($request, $route_name, $parameters = []) {
        $request_context = new RequestContext();
        $request_context->fromRequest($request);

        $generator = new UrlGenerator($this->routes, $request_context);

        return $generator->generate($route_name, $parameters);
    }

}
