<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreBundle:Front:index.html.twig');
    }

    public function ajaxnatureAction(Request $request)
    {
       //$request = $this->get('request');
        $response = new Response;
         
        if($request->isXmlHttpRequest())
        {
            $term = $this->get('motcle');
             
            $array= $this->getDoctrine()
                ->getManager()
                ->getRepository('CoreBundle:Espece')
                ->listeNature($term);
             
            $response = new Response(json_encode($array));
             
            $response->headers->set('Content-Type', 'application/json');
            return $response;      
        }
        else {
            return $this->render('CoreBundle:Front:testAUto.html.twig');
        }
    }
}
