<?php

// src/Nao/CoreBundle/Controller/FrontController.php

namespace Nao\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('NaoCoreBundle:Front:index.html.twig');
    }
}