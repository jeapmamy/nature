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
      return $this->render('CoreBundle:Front:admin.html.twig');
      }
	
}
