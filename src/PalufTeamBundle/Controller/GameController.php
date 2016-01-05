<?php

namespace PalufTeamBundle\Controller;

use PalufBundle\Entity\Comment;
use PalufBundle\Entity\Game;
use PalufTeamBundle\FormData\ScoreData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class GameController extends Controller
{
    /**
     * @Route("/game/{id}", name="team_game")
     */
    public function indexAction(Game $game, Request $request)
    {
        if($game->getDone()) {

        }

        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        if ($game->getTeamA()->getId() !== $userTeam->getId()
            && $game->getTeamB()->getId() !== $userTeam->getId()) {
            throw $this->createNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();
        $terms = $em->getRepository('PalufBundle:Term')->findBy(['game' => $game]);
        $form = $this->createCommentForm($request);
        $scoreForm = $this->createScoreForm($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $data = $form->getData();

            $comment = new Comment();
            $comment->setAuthor($userTeam);
            $comment->setDatetime(new \DateTime());
            $comment->setGame($game);
            $comment->setText($data->text);

            $em->persist($comment);
            $em->flush();

            return $this->redirect($request->getRequestUri());
        }

        if ($scoreForm->isValid() && $scoreForm->isSubmitted()) {
            $data = $scoreForm->getData();

            if ($userTeam->getId() == $game->getTeamA()->getId()) {
                $game->setAResult1($data->resultA);
                $game->setAResult2($data->resultB);
            } else {
                $game->setBResult1($data->resultA);
                $game->setBResult2($data->resultB);
            }


            $em->persist($game);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Skóre bylo úspěšně nastaveno.');
            return $this->redirect($request->getRequestUri());
        } else if (!$scoreForm->isSubmitted()) {
            $scoreData = new ScoreData();

            if ($userTeam->getId() == $game->getTeamA()->getId()) {
                $scoreData->resultA = $game->getAResult1();
                $scoreData->resultB = $game->getAResult2();
            } else {
                $scoreData->resultA = $game->getBResult1();
                $scoreData->resultB = $game->getBResult2();
            }

            $scoreForm->setData($scoreData);
        }

        return $this->render('PalufTeamBundle:Game:index.html.twig', array(
            "team" => $userTeam,
            "game" => $game,
            "tournament" => $game->getTournament(),
            "terms" => $terms,
            "comment_form" => $form->createView(),
            "score_form" => $scoreForm->createView(),
        ));
    }

    public function createCommentForm(Request $request)
    {
        $form = $this->createForm("PalufTeamBundle\\Form\\CommentType");
        $form->handleRequest($request);
        return $form;
    }

    public function createScoreForm(Request $request)
    {
        $form = $this->createForm("PalufTeamBundle\\Form\\ScoreType");
        $form->handleRequest($request);
        return $form;
    }

    /**
     * @Route("/game/{id}/confirm", name="team_game_confirm")
     * @param Request $request
     */
    public function confirmAction(Request $request, Game $game)
    {
        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        if ($game->getTeamA()->getId() !== $userTeam->getId()
            && $game->getTeamB()->getId() !== $userTeam->getId()) {
            throw $this->createNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();

        if ($userTeam->getId() == $game->getTeamA()->getId()) {
            $game->setAResult1($game->getBResult1());
            $game->setAResult2($game->getBResult2());
        } else {
            $game->setBResult1($game->getAResult1());
            $game->setBResult2($game->getAResult2());
        }
        $game->setDone(true);

        $em->persist($game);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Výsledek zápasu byl úspěšně potvrzen.');
        return $this->redirect($this->generateUrl('team_tournaments', [
            'id' => $game->getId(),
        ]));
    }

}
