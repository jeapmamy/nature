<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreBundle:Front:index.html.twig');
    }
	
	/**
	 *@Security("has_role('ROLE_ADMIN')")
	 */
	public function adminAction()
    {		
		return $this->render('CoreBundle:Front:admin.html.twig');
    }
}
