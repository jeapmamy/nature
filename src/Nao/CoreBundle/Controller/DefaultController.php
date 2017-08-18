<?php

namespace Nao\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NaoCoreBundle:Default:index.html.twig');
    }
}
