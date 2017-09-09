<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Espece;
use CoreBundle\Entity\Observation;
use CoreBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\EspeceType;
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
            $listeObservation = $em->getRepository('CoreBundle:Observation')->mase($id);
            $response = new Response(json_encode($listeObservation));
            $response -> headers -> set('Content-Type', 'application/json');
            return $response;      
        }
    }

	
//Page Observation
	/**
     *@Security("has_role('ROLE_USER')")
     */
    public function observationAction(Request $request)
    {

		$observation = new Observation();
		$form = $this->createForm(ObservationType::class, $observation);
        $espece = new Espece();

        //recupere l'id de l'user
        $user = $this->getUser()->getid();
        //DECOMMENTER POUR VOIR LES DONNEES USER
        //var_dump($user); die();

		if ($request->isXmlHttpRequest()) {

            /*$form->handleRequest($request);

            if ($form->isValid()) {*/

                //RECUPERATION DES DONNEES FORM AJAX
    			$date = $request->request->get('date');
                $espece_id = $request->request->get('id_espece');
                $latitude = $request->request->get('latitude');
                $longitude = $request->request->get('longitude');
                //FIN

                $em = $this->getDoctrine()->getManager();

                //AJOUT DES DONNEES A UNE NOUVELLE INSTANCE OBSERVATION
                $observation->setDate($date);
                $observation->setLatitude($latitude);
                $observation->setLongitude($longitude);
                $observation->setStatut(1); // VOIR POUR LE METTRE VALEUR PAR DEFAUT EN FONCTION DU TYPE DE L'USER
    			
                //BEUG SI DECOMMENTER $observation->setUser($user);
                
    			$em->persist($observation);
    			$em->flush($observation);
            }
			//$request->getSession()->getFlashBag()->add('info', 'Observation bien enregistrée.');

			//return $this->redirectToRoute('core_index');
		

		return $this->render('CoreBundle:Front:observation.html.twig', array(
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
    public function contactAction()
    {
        return $this->render('CoreBundle:Front:contact.html.twig');
    }
	
}
