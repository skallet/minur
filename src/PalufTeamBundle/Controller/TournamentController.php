<?php

namespace PalufTeamBundle\Controller;

use Doctrine\ORM\EntityManager;
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
        if($userTeam instanceof \PalufBundle\Entity\Admin) {
            return $this->redirect('/admin/tournament', 302);
        }
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
            'games' => array_reverse($games),
        ));
    }



    /**
     * Finds and displays a Page entity.
     *
     * @Route("/tournament-unreg/{id}", name="team_tournament_unregister")
     */
    public function unregisterAction(Tournament $tournament)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var Team $userTeam */
        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        $userTeam->getTournaments()->removeElement($tournament);
        $tournament->getTeams()->removeElement($userTeam);
        $em->persist($userTeam);
        $em->persist($tournament);
        $em->flush();

        return $this->redirectToRoute('tournament_index');
    }


    /**
     * Finds and displays a Page entity.
     *
     * @Route("/tournament-reg/{id}", name="team_tournament_register")
     */
    public function registerAction(Tournament $tournament)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var Team $userTeam */
        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        $userTeam->getTournaments()->add($tournament);
        $tournament->getTeams()->add($userTeam);
        $em->persist($userTeam);
        $em->persist($tournament);
        $em->flush();

        return $this->redirectToRoute('tournament_index');
    }

}
