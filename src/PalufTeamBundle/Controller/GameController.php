<?php

namespace PalufTeamBundle\Controller;

use PalufBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class GameController extends Controller
{
    /**
     * @Route("/game/{id}", name="team_game")
     */
    public function indexAction(Game $game)
    {
        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        if ($game->getTeamA()->getId() !== $userTeam->getId()
            && $game->getTeamB()->getId() !== $userTeam->getId()) {
            throw $this->createNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();
        $terms = $em->getRepository('PalufBundle:Term')->findBy(['game' => $game]);

        return $this->render('PalufTeamBundle:Game:index.html.twig', array(
            "team" => $userTeam,
            "game" => $game,
            "tournament" => $game->getTournament(),
            "terms" => $terms,
        ));
    }

}
