<?php

namespace PalufBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use PalufBundle\Entity\Team;
use PalufBundle\FormData\RegistrationData;
use PalufBundle\Security\User\PalufUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/registration", name="registration_page")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm("PalufBundle\\Form\\RegistrationType");
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var RegistrationData $data */
            $data = $form->getData();
            $team = new Team();
            $team->setEmail($data->email);
            $team->setName($data->name);
            $team->setDescription($data->description);

            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword(new PalufUser($team), $data->password);
            $team->setPassword($password);

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();

                return $this->redirectToRoute('landingpage');
            } catch (UniqueConstraintViolationException $e) {
                $form->addError(new FormError($this->get('translator')->trans('Entry is not unique.')));
            }
        }

        return $this->render('PalufBundle:Registration:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
