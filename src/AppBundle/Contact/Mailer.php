<?php

declare(strict_types = 1);

namespace AppBundle\Contact;

use AppBundle\DataObject\Contact;
use AppBundle\Entity\User;
use AppBundle\Entity\Users;
use Twig\Environment as Twig;

class Mailer
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Twig $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendSubscriptionConfirmation(Contact $contact): void
    {
        $name = $contact->getName();
        $email = $contact->getEmail();

        $body = $this->twig->render(
            'email/subscription.html.twig',
            ['name' => $name]
        );

        $message = (new \Swift_Message('Subscription Confirmation'))
            ->setFrom(Contact::EMAIL_ADDRESS_SENDER)
            ->setTo($email)
            ->setSubject($this->twig->render('email/subscription_subject.html.twig'))
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }


    public function sendRegistrationConfirmation(Users $user): void
    {
        $name = sprintf('%s %s', $user->getFirstName(), $user->getLastName());
        $email = $user->getEmail();

        $body = $this->twig->render(
            'email/subscription.html.twig',
            ['name' => $name]
        );

        $message = (new \Swift_Message('Registration Confirmation'))
            ->setFrom(Contact::EMAIL_ADDRESS_SENDER)
            ->setTo($email)
            ->setSubject($this->twig->render('email/subscription_subject.html.twig'))
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}
