<?php

namespace App\Controller;

use App\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends ControllerBase
{

    public function loginAction() {
        return new Response(__METHOD__);
    }

}
