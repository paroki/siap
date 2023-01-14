<?php


namespace Paroki\User;


use Doctrine\ORM\EntityManagerInterface;
use Paroki\Core\ModelManagerTrait;
use Paroki\User\Entity\User;

class UserManager
{
    use ModelManagerTrait;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
        $this->repository = $em->getRepository(User::class);
    }

    public function findByEmail(mixed $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }

}