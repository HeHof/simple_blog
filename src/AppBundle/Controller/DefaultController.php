<?php

declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Contact\Mailer;
use AppBundle\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/random_post", name="random_post")
     */
    public function randomPostAction(): Response
    {
        return $this->render('default/random_post.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(): Response
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request, TranslatorInterface $translator): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get(Mailer::class)->sendSubscriptionConfirmation($form->getData());
            $this->addFlash('notice', $translator->trans('flashbag.newsletter_success'));

            return $this->redirectToRoute('index');
        }

        return $this->render('default/contact.html.twig', ['form' => $form->createView()]);
    }
}
