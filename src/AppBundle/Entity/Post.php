<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Post
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=150)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(length=100)
     */
    private $category;

    /**
     * @ORM\Column(length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
