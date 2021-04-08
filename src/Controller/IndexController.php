<?php

namespace App\Controller;

use App\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends ControllerBase
{

    public function indexAction() {
        $sth = $this->db()->prepare('SELECT * FROM contact ORDER BY id ASC');
        $sth->execute();

        $records = [];
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $records[] = $row;
        }

        return new Response($this->render('index.html.twig', ['records' => $records]));
    }

}
