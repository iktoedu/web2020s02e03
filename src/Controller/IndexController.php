<?php

namespace App\Controller;

use App\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends ControllerBase
{

    public function indexAction() {
        return new Response($this->render('_page.html.twig', ['content' => 'Hello world!']));
    }

}
