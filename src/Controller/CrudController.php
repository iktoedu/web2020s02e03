<?php

namespace App\Controller;

use App\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends ControllerBase
{

    public function addAction(Request $request) {
        $vars = [];

        if ($request->getMethod() == 'POST') {
            $input = [];
            $fields = ['name_last', 'name_first', 'name_patronymic'];
            foreach ($fields as $field) {
                $input[$field] = $request->request->get($field);
            }

            $sql = 'INSERT INTO contact (' . implode(', ', $fields) . ') VALUES (' . implode(', ', array_fill(0, count($fields), '?')) . ')';
            $sth = $this->db()->prepare($sql);
            $sth->execute(array_values($input));

            return new RedirectResponse($this->generateUrl($request, 'index'));
        }

        return new Response($this->render('add.html.twig', $vars));
    }

}
