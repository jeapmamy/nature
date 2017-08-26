<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Espece;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\EspeceType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;

class FrontController extends Controller
{
    public function indexAction()
    {
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);
        return $this->render('CoreBundle:Front:index.html.twig',
            array(
           'form' => $form->createView(),
           ));
    }

    public function ajaxnatureAction(Request $request)
    {   
        if($request->isXmlHttpRequest())
        {
            $company = $request->request->get('company');
            $em = $this->getDoctrine()->getManager(); 
            $dalaliens = $em->getRepository('CoreBundle:Espece')->listeNature($company); 
             
            $response = new Response(json_encode($dalaliens));
             
            $response -> headers -> set('Content-Type', 'application/json');
            return $response;      
        }
    }
}
