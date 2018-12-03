<?php

declare(strict_types = 1);

namespace AppBundle\DataObject;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    public const EMAIL_ADDRESS_SENDER = 'hendrik.h.hofmann@gmail.com';

    /**
     * @Assert\NotBlank(message="Sure you don't have a name?")
     * @Assert\Length(min="1", max="100")
     */
    private $name = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email = '';

    /**
     * @Assert\NotBlank()
     */
    private $message = '';

    /**
     * @Assert\NotBlank()
     */
    private $phone = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
