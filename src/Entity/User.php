<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public static function create(){
        return new static;
    }

    /**
     * @ORM\Column(unique=true,length=50)
     * @var string|null
     */
    private $username;

    /**
     * @ORM\Column()
     * @var string|null
     */
    private $password;

    /**
     * @var Article[]ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user")
     */
    private $articleCollection;

    public function __construct()
    {
        $this->articleCollection = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string[]
     */

    public function getRoles()
    {
        return ['ROLE_USER','ROLE_ADMIN'];
    }

    /**
     * @return string
     */

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getArticlesCollection(): ArrayCollection
    {
        return $this->articleCollection;
    }
    public function addArticlesCollection(Article $article): self
    {
        $this->articleCollection->add($article);

        return $this;
    }
    public function removeArticlesCollection(Article $article): self
    {
        $this->articleCollection->remove($article);
        return $this;
    }

}