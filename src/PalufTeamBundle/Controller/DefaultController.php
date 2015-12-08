<?php

namespace PalufTeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="team_landingpage")
     */
    public function indexAction()
    {
        return $this->render('PalufTeamBundle:Default:index.html.twig');
    }
}
