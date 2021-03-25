<?php

namespace App\Controller;

use App\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class NotFoundController extends ControllerBase
{

    public function indexAction() {
        return new Response('Not found!', 404);
    }

}
