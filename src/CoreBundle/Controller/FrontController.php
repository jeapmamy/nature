<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Espece;
use CoreBundle\Entity\Observation;
use CoreBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\EspeceType;
use CoreBundle\Form\ContactType;
use CoreBundle\Form\ObservationType;
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
    public function autocompletionAction(Request $request)
    {   
        if($request->isXmlHttpRequest())
        {
            $oiseau = $request->request->get('oiseau');
            $em = $this->getDoctrine()->getManager(); 
            $listeEspece = $em->getRepository('CoreBundle:Espece')->listeEspece($oiseau); 
            $response = new Response(json_encode($listeEspece));
            $response -> headers -> set('Content-Type', 'application/json');
            return $response;      
        }
    }

//Permet de récupérer la fiche de l'espèce par ID
    public function searchFicheEspeceAction(Request $request, $id)
    {   
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager(); 
            $searchFicheEspece = $em->getRepository('CoreBundle:Espece')->searchBird($id); 
            $response = new Response(json_encode($searchFicheEspece));
            $response -> headers -> set('Content-Type', 'application/json');
            return $response;      
        }
    }
//searchObservation
    public function searchObservationAction(Request $request, $id)
    {   
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager(); 
            $listeObservation = $em->getRepository('CoreBundle:Observation')->chercheObservation($id);
            $response = new Response(json_encode($listeObservation));
            $response -> headers -> set('Content-Type', 'application/json');
            return $response;      
        }
    }

//Page recherche pour observation
	/**
     *@Security("has_role('ROLE_USER')")
     */
    public function observationAction(Request $request)
    {
        $Espece = new Espece();
        $form = $this->get('form.factory')->create(EspeceType::class, $Espece);
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			
			return $this->redirectToRoute('core_obssaisie', array('id' => id));
		}
		
        return $this->render('CoreBundle:Front:observation.html.twig',
            array(
           'form' => $form->createView(),
           )
        );
    }
	
//Page Observation
	/**
     *@Security("has_role('ROLE_USER')")
     */
    public function saisieAction(Request $request, $id)
    {
		$observation = new Observation();
		$form = $this->createForm(ObservationType::class, $observation);
        //recupere l'id de l'user
        $user = $this->getUser();
		
		$em = $this->getDoctrine()->getManager();
   
		$espece = $em->getRepository('CoreBundle:Espece')->find($id);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            
			$em = $this->getDoctrine()->getManager();
			
			if ($this->isGranted('ROLE_ADMIN')) {
				$observation->setStatut(true);
			} 
			else {
				$observation->setStatut(false);
			}
			
			$observation->setUser($user);
			//$RecupEspece = $em->getRepository('CoreBundle:Espece')->find($id); 
			$observation->setEspece($espece);
			$em->persist($observation);
			$em->flush($observation);
			
			if ($observation->getStatut() === true) {
				$this->addFlash('success', 'Votre observation a bien été enregistrée.');
			} 
			elseif ($observation->getStatut() === false){
				$this->addFlash('info', 'Votre observation a été enregistrée, elle est en attente de validation.');
			}
			
			return $this->redirectToRoute("core_observation");
			
		}
		return $this->render('CoreBundle:Front:saisie.html.twig', array(
			'espece' => $espece,
			'form' => $form->createView(),
		));
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
    public function contactAction(Request $request)
    {
		$form = $this->createForm(ContactType::class);
		
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			
			$data = $form->getData();
			
			$message = (new \Swift_Message())
				->setSubject($data['email']. '- Message de : ' .$data['nom']. ' ' .$data['prenom'])
				->setFrom($data['email'])
				->setTo(['contact.nao2017@gmail.com' => 'Association NAO'])
				->setBody($form->getData()['message'],
					'text/plain'
				);
			
			$this->get('mailer')->send($message);
				
			$this->addFlash('success', 'Votre message a été envoyé avec succes.');
			
			return $this->redirectToRoute("core_index");
	
        }
		
		return $this->render('CoreBundle:Front:contact.html.twig', array(
			'form' => $form->createView(),
		));
       
    }
        
	
}
