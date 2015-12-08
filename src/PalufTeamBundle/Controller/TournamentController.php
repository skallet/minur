<?php

namespace PalufTeamBundle\Controller;

use PalufBundle\Entity\Game;
use PalufBundle\Entity\Team;
use PalufBundle\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TournamentController extends Controller
{
    /**
     * @Route("/tournaments", name="team_tournaments")
     */
    public function indexAction()
    {
        /** @var Team $user */
        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        $games = [];
        /** @var Tournament $tournament */
        foreach ($userTeam->getTournaments() as $tournament) {
            /** @var Game $game */
            foreach ($tournament->getGames() as $game) {
                if ($game->getTeamA()->getId() == $userTeam->getId()
                    || $game->getTeamB()->getId() == $userTeam->getId()) {
                    $games[] = $game;
                }
            }
        }

        return $this->render('PalufTeamBundle:Tournament:index.html.twig', array(
            'team' => $userTeam,
            'games' => $games,
        ));
    }

}
