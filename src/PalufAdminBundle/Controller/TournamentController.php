<?php

namespace PalufAdminBundle\Controller;

use PalufAdminBundle\Form\TournamentType;
use PalufBundle\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tournament controller.
 *
 * @Route("/tournament")
 */
class TournamentController extends Controller
{
    /**
     * @Route("/", name="tournament_list")
     */
    public function indexAction()
    {
        return $this->render('PalufAdminBundle:Tournament:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/create", name="tournament_new")
     */
    public function createAction(Request $request)
    {
        $tournament = new Tournament();
        $form = $this->createForm("PalufAdminBundle\\Form\\TournamentType", $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournament);
            $em->flush();

            return $this->redirectToRoute('tournament_view', array('id' => $tournament->getId()));
        }

        return $this->render('PalufAdminBundle:Tournament:create.html.twig', array(
            'tournament' => $tournament,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="tournament_view")
     */
    public function viewAction(Tournament $tournament)
    {
        $deleteForm = $this->createDeleteForm($tournament);

        return $this->render('PalufAdminBundle:Tournament:view.html.twig', array(
            'tournament' => $tournament,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     * @Route("/{id}/edit", name="tournament_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tournament $tournament)
    {
        $deleteForm = $this->createDeleteForm($tournament);
        $editForm = $this->createForm(new TournamentType(), $tournament);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournament);
            $em->flush();

            return $this->redirectToRoute('tournament_edit', array('id' => $tournament->getId()));
        }

        return $this->render('PalufAdminBundle:Tournament:edit.html.twig', array(
            'tournament' => $tournament,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Page entity.
     *
     * @Route("/{id}", name="tournament_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tournament $tournament)
    {
        $form = $this->createDeleteForm($tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tournament);
            $em->flush();
        }

        return $this->redirectToRoute('tournament_list');
    }

    /**
     * Creates a form to delete a Page entity.
     *
     * @param Tournament $tournament
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tournament $tournament)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tournament_delete', array('id' => $tournament->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
