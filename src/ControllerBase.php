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

    /**
     * @var \PDO
     */
    private $db;

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

}
