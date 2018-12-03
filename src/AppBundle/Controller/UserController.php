<?php

declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Contact\Mailer;
use AppBundle\Form\LoginFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserRegistrationFormType;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     *@Route("/register", name="register")
     */
    public function registerAction(Request $request, TranslatorInterface $translator, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Users();
        $form = $this->createForm(UserRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->container->get(Mailer::class)->sendRegistrationConfirmation($form->getData());
            $this->addFlash('notice', $translator->trans('flashbag.registration_success'));

            return $this->redirectToRoute('index');
        }
        return $this->render('default/register.html.twig', ['form' => $form->createView()]);
    }

    /**
     *@Route("/login", name="login")
     */
    public function loginAction (Request $request): Response
    {
        $form = $this->createForm(LoginFormType::class);
        $form->handleRequest($request);

        return $this->render('default/register.html.twig', ['form' => $form->createView()]);

    }
}
