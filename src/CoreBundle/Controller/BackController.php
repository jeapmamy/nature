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
		
        $observation->setStatut(true);
		
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
		
        $user->setPro(false);
		$user->setRoles(['ROLE_ADMIN']);
		
        $em->persist($user); 
        $em->flush(); 
		
		// Envoi d'un email
		$email = $user->getEmail();
	
		$message = (new \Swift_Message())
			->setSubject('Confirmation de votre nouveau statut')
			->setFrom(['contact.nao2017@gmail.com' => 'Association NAO'])
			->setTo($email)
			->setBody($this->renderView(
				'Emails/mail.html.twig', array(
					'user' => $user,)
				),
				'text/html'
			)
		;

		$this->get('mailer')->send($message);
		
        $this->addFlash('success', 'Le membre a maintenant le statut "Naturaliste".');
		$this->addFlash('success', 'Une confirmation, par email, vient de lui être envoyée.');
		
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
		
		$user->setPro(false);
		
        $em->persist($user); 
        $em->flush(); 
		
        $this->addFlash('info', 'Le statut "Naturaliste" n\'a pas été accordé à ce membre.'); 
		
        return $this->redirectToRoute('core_admin'); 
    }
	
}

