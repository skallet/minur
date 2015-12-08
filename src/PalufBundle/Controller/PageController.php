<?php

namespace PalufBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PalufBundle\Entity\Page;
use PalufBundle\Form\PageType;

/**
 * Page controller.
 *
 * @Route("/page")
 */
class PageController extends Controller
{
    public function navbarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('PalufBundle:Page')->findAll();

        return $this->render('PalufBundle:Page:navbar.html.twig', array(
            'pages' => $pages,
        ));
    }


    /**
     * Finds and displays a Page entity.
     *
     * @Route("/{id}", name="page_show")
     * @Method("GET")
     */
    public function showAction(Page $page)
    {
        return $this->render('PalufBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }

}
