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
//Page accueil
    public function indexAction(Request $request)
    {
        return $this->render('CoreBundle:Front:index.html.twig');
    }

//Page recherche
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

//Permet de  la liste des espèces pour l'autocomplétion 
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
	
	//Page Observation
    public function observationAction()
    {
        return $this->render('CoreBundle:Front:observation.html.twig');
    }
	
	//Page Association
    public function associationAction()
    {
        return $this->render('CoreBundle:Front:association.html.twig');
    }
	
	//Page Mentions-Légales
    public function mentionsLegalesAction()
    {
        return $this->render('CoreBundle:Front:mentions_legales.html.twig');
    }
	
	//Page Contact
    public function contactAction()
    {
        return $this->render('CoreBundle:Front:contact.html.twig');
    }
	
}
