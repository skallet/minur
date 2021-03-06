<?php

namespace PalufBundle\Controller;

use PalufBundle\Entity\Tournament;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Page controller.
 *
 * @Route("/tournament")
 */
class TournamentController extends Controller
{

    /**
     * Finds and displays a Page entity.
     *
     * @Route("/", name="tournament_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userTournaments = [];

        $userTeam = $this->get('security.token_storage')->getToken()->getUser();
        if ($userTeam != "anon.")
            $userTournaments = $userTeam->getUser()->getTournaments()->toArray();


        $tournaments = $em->getRepository('PalufBundle:Tournament')->findAll();

        return $this->render('PalufBundle:Tournament:index.html.twig', array(
            'tournaments' => $tournaments,
            'userTournaments' => array_keys($userTournaments),
        ));
    }


    /**
     * Finds and displays a Page entity.
     *
     * @Route("/{id}", name="tournament_show")
     * @Method("GET")
     */
    public function showAction(Tournament $tournament)
    {
        return $this->render('PalufBundle:Tournament:show.html.twig', array(
            'tournament' => $tournament,
        ));
    }

}
