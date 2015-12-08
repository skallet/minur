<?php

namespace PalufAdminBundle\Controller;

use Doctrine\ORM\EntityManager;
use PalufAdminBundle\Form\GameType;
use PalufBundle\Entity\Game;
use PalufBundle\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Game controller.
 *
 * @Route("/game/{tournament}")
 */
class GameController extends Controller
{
    /**
     * @Route("/", name="admin_game_list")
     */
    public function indexAction(Tournament $tournament)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $tournaments = $em->getRepository('PalufBundle:Game')->findBy(['tournament'=>$tournament], ['round'=>"asc"]);

        return $this->render('PalufAdminBundle:Game:index.html.twig', array(
            'games' => $tournaments,
            'tournament' => $tournament,
        ));
    }

    /**
     * @Route("/create", name="admin_game_new")
     */
    public function createAction(Request $request, Tournament $tournament)
    {
        $game = new Game();
        $form = $this->createForm("PalufAdminBundle\\Form\\GameType", $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $game->setTournament($tournament);
            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('admin_game_view', array('tournament' => $tournament->getId(), 'id' => $game->getId()));
        }

        return $this->render('PalufAdminBundle:Game:create.html.twig', array(
            'game' => $game,
            'tournament' => $tournament,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="admin_game_view")
     */
    public function viewAction(Tournament $tournament, Game $game)
    {
        $deleteForm = $this->createDeleteForm($tournament, $game);

        return $this->render('PalufAdminBundle:Game:view.html.twig', array(
            'game' => $game,
            'tournament' => $tournament,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     * @Route("/{id}/edit", name="admin_game_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tournament $tournament, Game $game)
    {
        $deleteForm = $this->createDeleteForm($tournament, $game);
        $editForm = $this->createForm("PalufAdminBundle\\Form\\GameType", $game);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('admin_game_edit', array('tournament'=>$tournament->getId(), 'id' => $game->getId()));
        }

        return $this->render('PalufAdminBundle:Game:edit.html.twig', array(
            'game' => $game,
            'tournament' => $tournament,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Page entity.
     *
     * @Route("/{id}", name="admin_game_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tournament $tournament, Game $game)
    {
        $form = $this->createDeleteForm($tournament, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($game);
            $em->flush();
        }

        return $this->redirectToRoute('admin_game_list', ['tournament'=>$tournament->getId()]);
    }

    /**
     * Creates a form to delete a Page entity.
     *
     * @param Game $game
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tournament $tournament, Game $game)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_game_delete', array('tournament' => $tournament->getId(), 'id' => $game->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
