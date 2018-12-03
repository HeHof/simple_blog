<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="userName", message="Username already taken")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(length=150)
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @ORM\Column(length=100)
     * @Assert\NotBlank()
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;


    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }


    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
}
