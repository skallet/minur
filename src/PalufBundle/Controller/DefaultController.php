<?php

namespace PalufBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PalufBundle:Page')->findAll();

        return $this->render('default/index.html.twig', [
            'pages' => $pages,
        ]);
    }
}
