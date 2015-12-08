<?php

namespace PalufTeamBundle\Controller;

use PalufBundle\Entity\Comment;
use PalufBundle\Entity\Game;
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
        $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
        if ($game->getTeamA()->getId() !== $userTeam->getId()
            && $game->getTeamB()->getId() !== $userTeam->getId()) {
            throw $this->createNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();
        $terms = $em->getRepository('PalufBundle:Term')->findBy(['game' => $game]);
        $form = $this->createCommentForm($request);

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

        return $this->render('PalufTeamBundle:Game:index.html.twig', array(
            "team" => $userTeam,
            "game" => $game,
            "tournament" => $game->getTournament(),
            "terms" => $terms,
            "comment_form" => $form->createView(),
        ));
    }

    public function createCommentForm(Request $request)
    {
        $form = $this->createForm("PalufTeamBundle\\Form\\CommentType");
        $form->handleRequest($request);
        return $form;
    }

}
