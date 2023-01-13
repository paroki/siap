<?php


namespace Paroki\User;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Paroki\User\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    )
    {
        $this->em = $em;
        $this->hasher = $hasher;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->getRepository()->findOneBy([
            'email' => $email
        ]);
    }

    public function save(User $user): void
    {
        // hash user password
        $user->setPassword($this->hasher->hashPassword($user, $user->getPlainPassword()));

        $this->em->persist($user);
        $this->em->flush();
    }

    private function getRepository(): ObjectRepository
    {
        return $this->em->getRepository(User::class);
    }
}