<?php

namespace PalufTeamBundle\Controller;

use PalufBundle\Entity\Game;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PalufBundle\Entity\Term;
use PalufBundle\Form\TermType;

/**
 * Term controller.
 *
 * @Route("/term")
 */
class TermController extends Controller
{

    /**
     * Creates a new Term entity.
     *
     * @Route("/{game}/{day}/new", name="term_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Game $game, \DateTime $day)
    {
        $term = new Term();
        $form = $this->createForm('\PalufTeamBundle\Form\TermType', $term);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $term->setGame($game);
            $term->setDay($day);
            /** @var Team $userTeam */
            $userTeam = $this->get('security.token_storage')->getToken()->getUser()->getUser();
            $term->setTeam($userTeam);
            $em = $this->getDoctrine()->getManager();
            $em->persist($term);
            $em->flush();

            return $this->redirectToRoute('team_game', array('id' => $game->getId()));
        }

        return $this->render('PalufTeamBundle:Term:new.html.twig', array(
            'term' => $term,
            'form' => $form->createView(),
            'game' => $game,
            'day' => $day,
        ));
    }



    /**
     * Displays a form to edit an existing Term entity.
     *
     * @Route("/{id}/edit", name="term_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Term $term)
    {
        $editForm = $this->createForm('\PalufTeamBundle\Form\TermType', $term);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($term);
            $em->flush();

            return $this->redirectToRoute('team_game', array('id' => $term->getGame()->getId()));
        }

        return $this->render('PalufTeamBundle:Term:edit.html.twig', array(
            'term' => $term,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Term entity.
     *
     * @Route("/delete/{id}", name="term_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Term $term)
    {
        $game = $term->getGame();
        $em = $this->getDoctrine()->getManager();
        $em->remove($term);
        $em->flush();

        return $this->redirectToRoute('team_game', array('id' => $game->getId()));
    }


    /**
     * Deletes a Term entity.
     *
     * @Route("/confirm/{id}", name="term_confirm")
     * @Method("GET")
     */
    public function confirmAction(Request $request, Term $term)
    {
        $game = $term->getGame();
        $game->setFinalTerm($term);
        $em = $this->getDoctrine()->getManager();
        $em->persist($game);
        $em->flush();

        return $this->redirectToRoute('team_game', array('id' => $game->getId()));
    }

    /**
     * Deletes a Term entity.
     *
     * @Route("/unconfirm/{id}", name="term_unconfirm")
     * @Method("GET")
     */
    public function unconfirmAction(Request $request, Term $term)
    {
        $game = $term->getGame();
        $game->setFinalTerm(NULL);
        $em = $this->getDoctrine()->getManager();
        $em->persist($game);
        $em->flush();

        return $this->redirectToRoute('team_game', array('id' => $game->getId()));
    }
}
