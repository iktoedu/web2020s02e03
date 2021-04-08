<?php

namespace App\Controller;

use App\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends ControllerBase
{

    public function loginAction(Request $request) {
        if (!empty($request->getSession()->get('is_logged_in'))) {
            return new RedirectResponse($this->generateUrl($request, 'index'));
        }

        $vars = [];
        if ($request->getMethod() == 'POST') {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            if ($username == 'admin' && $password == 'admin') {
                $request->getSession()->set('is_logged_in', TRUE);
                return new RedirectResponse($this->generateUrl($request, 'index'));
            }
            else {
                $vars['error'] = 'Невірний логін або пароль.';
            }
        }


        return new Response($this->render('login.html.twig', $vars));
    }

}
