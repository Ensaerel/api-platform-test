<?php

namespace AppBundle\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use AppBundle\Entity\Behavior;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"method"="GET"},
 *         "post"={"method"="POST", "validation_groups"={"Default", "create"}}
 *     },
 *     itemOperations={
 *         "get"={"method"="GET"},
 *         "put"={"method"="PUT"},
 *         "delete"={"method"="DELETE"}
 *     },
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     }
 * )
 *
 * @UniqueEntity(
 *     fields={"username"},
 *     errorPath="username",
 *     message="This username is already used",
 * )
 * @UniqueEntity(
 *     fields={"email"},
 *     errorPath="email",
 *     message="This email address is already used",
 * )
 *
 * @ORM\Entity()
 * @ORM\Table(name="user_user")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @Groups({"read"})
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Groups({"read", "write"})
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     *
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @Groups({"read", "write"})
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Email()
     *
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40)
     */
    protected $salt;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var string
     *
     * @Groups({"write"})
     *
     * @Assert\NotBlank(groups={"create", "update_password"})
     * @Assert\Length(max="255")
     */
    protected $plainPassword;

    use Behavior\TimestampableTrait;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param bool $fallback
     * @return string
     */
    public function getSalt($fallback = true): ?string
    {
        if (!$this->salt && $fallback) {
            $this->setSalt(sha1(uniqid()));
        }

        return $this->salt;
    }

    /**
     * @param string $salt
     * @return User
     */
    public function setSalt(string $salt): User
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword(string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Useless here
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * @return void
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function __toString(): ?string
    {
        return $this->getUsername();
    }
}
