<?php


namespace Paroki\User\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Paroki\Referensi\Entity\Paroki;
use Paroki\User\UserPasswordHasher;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: UserPasswordHasher::class),
        new Get(),
        new Put(processor: UserPasswordHasher::class),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:create', 'user:update']],
)]
#[ORM\Entity]
#[ORM\Table(name: 'core_user')]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_PAROKI_ADMIN = 'ROLE_PAROKI_ADMIN';
    const ROLE_KEUSKUPAN_ADMIN = 'ROLE_KEUSKUPAN_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';


    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[Groups(['user:read'])]
    private ?string $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $email = null;

    #[ORM\Column()]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private ?string $plainPassword = null;

    #[Groups(['user:create', 'user:update'])]
    #[ORM\Column(type: 'json')]
    private array $roles = [self::ROLE_USER];

    #[ORM\ManyToOne(targetEntity: Paroki::class)]
    private ?Paroki $paroki = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Paroki|null
     */
    public function getParoki(): ?Paroki
    {
        return $this->paroki;
    }

    /**
     * @param Paroki|null $paroki
     * @return User
     */
    public function setParoki(?Paroki $paroki): User
    {
        $this->paroki = $paroki;
        return $this;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param array|string[] $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = static::ROLE_USER;
        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

}