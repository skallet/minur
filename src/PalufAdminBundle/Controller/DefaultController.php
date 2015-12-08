<?php

namespace PalufAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_landingpage")
     */
    public function indexAction()
    {
        return $this->render('PalufAdminBundle:Default:index.html.twig');
    }

    public function navbarAction()
    {
        return $this->render('PalufAdminBundle:Default:navbar.html.twig', array(
        ));
    }
}
