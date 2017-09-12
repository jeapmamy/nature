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


class BackController extends Controller
{
		
    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function adminAction()
	{	
		$em = $this->getDoctrine()->getManager();
		
		$listObs = $em
			->getRepository('CoreBundle:Observation')
			->myFindBy();
		
		$listNats = $em
			->getRepository('CoreBundle:User')
			->myFindBy();
		
		return $this->render('CoreBundle:Back:admin.html.twig', array(
			'listObs' => $listObs,
			'listNats' => $listNats
		));
	}
	
	
	/**
     *@Security("has_role('ROLE_ADMIN')")
     */
	public function valideObsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $observation = $em
			->getRepository('CoreBundle:Observation')
			->find($id); 
		
        $observation->setStatut(1);
		
        $em->persist($observation); 
        $em->flush(); 
		
		$this->addFlash('success', 'L\'observation a été publiée avec succès.');
		
        return $this->redirectToRoute('core_admin'); 
    }
	
    
	/**
     *@Security("has_role('ROLE_ADMIN')")
     */
	public function deleteObsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $observation = $em
			->getRepository('CoreBundle:Observation')
			->find($id); 
		
        $em->remove($observation); 
        $em->flush(); 
		
        $this->addFlash('danger', 'L\'observation a été effacée.');
		
        return $this->redirectToRoute('core_admin'); 
    }
	
    
	/**
     *@Security("has_role('ROLE_ADMIN')")
     */
	public function valideNatAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $user = $em
			->getRepository('CoreBundle:User')
			->find($id); 
		
        $user->setPro(0);
		$user->setRoles(['ROLE_ADMIN']);
		
        $em->persist($user); 
        $em->flush(); 
		
        $this->addFlash('success', 'Le membre a maintenant le statut "Naturaliste".');
		
        return $this->redirectToRoute('core_admin'); 
    }
	
    
	/**
     *@Security("has_role('ROLE_ADMIN')")
     */
	public function refuseNatAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $user = $em
			->getRepository('CoreBundle:User')
			->find($id); 
		
		$user->setPro(0);
		
        $em->persist($user); 
        $em->flush(); 
		
        $this->addFlash('info', 'Le statut "Naturaliste" n\'a pas été accordé à ce membre.'); 
		
        return $this->redirectToRoute('core_admin'); 
    }
	
}

