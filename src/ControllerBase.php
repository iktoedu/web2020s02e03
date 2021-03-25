<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class ControllerBase
{

    /**
     * @var \Twig\Environment
     */
    private $twig;

    protected function render($template, $params) {
        if ($this->twig === NULL) {
            $loader = new FilesystemLoader(__DIR__ . '/../templates');
            $this->twig = new Environment($loader);
        }

        return $this->twig->render($template, $params);
    }

}
