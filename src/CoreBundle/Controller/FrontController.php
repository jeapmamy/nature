<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Espece;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\EspeceType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class FrontController extends Controller
{
    public function indexAction(Request $request)
    {
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);

        return $this->render('CoreBundle:Front:index.html.twig',
            array(
           'form' => $form->createView(),
           )
        );
    }

    public function searchEspeceAction(Request $request)
    {
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);

        return $this->render('CoreBundle:Front:recherche.html.twig',
            array(
           'form' => $form->createView(),
           )
        );
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

    //controlleur getBird pour la fiche espece en parametre un id
    //$.post('..')
    public function searchFicheEspeceAction(Request $request, $id)
    {   
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);
        if($request->isXmlHttpRequest())
        {

            //$company = $request->request->get('company');
            $em = $this->getDoctrine()->getManager(); 
            $dalaliens = $em->getRepository('CoreBundle:Espece')->searchBird($id); 
             
            $response = new Response(json_encode($dalaliens));
             
            $response -> headers -> set('Content-Type', 'application/json');
            return $response;      
        }
                return $this->render('CoreBundle:Front:recherche.html.twig',
                    array(
                   'form' => $form->createView(),
                   )
                );
    }
	
    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function adminAction()
      {		
      return $this->render('CoreBundle:Front:admin.html.twig');
      }
}
