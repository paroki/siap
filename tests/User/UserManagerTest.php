<?php

namespace Paroki\Tests\User;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Paroki\User\Entity\User;
use Paroki\User\UserManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManagerTest extends TestCase
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    private UserPasswordHasherInterface $hasher;
    private UserManager $manager;


    public function setUp(): void
    {
        $this->repository = $this->createMock(ObjectRepository::class);
        $this->em = $this->createMock(
            EntityManagerInterface::class
        );
        $this->em->expects($this->any())
            ->method('getRepository')
            ->with(User::class)
            ->willReturn($this->repository);

        $this->hasher = $this->createMock(UserPasswordHasherInterface::class);
        $this->manager = new UserManager($this->em, $this->hasher);
    }

    public function testFindByEmail()
    {
        $manager = $this->manager;
        $repository = $this->repository;

        $user = new User();
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => 'user@example.com'])
            ->willReturn($user)
        ;

        $this->assertSame($user, $manager->findByEmail('user@example.com'));
    }

    public function testCreateUser()
    {
        $manager = $this->manager;
        $em = $this->em;
        $hasher = $this->hasher;
        $user = $this->createMock(User::class);

        $user->expects($this->once())
            ->method('getPlainPassword')
            ->willReturn('password');
        $user->expects($this->once())
            ->method('setPassword')
            ->with('hashed');

        $hasher->expects($this->once())
            ->method('hashPassword')
            ->with($user, 'password')
            ->willReturn('hashed');

        $em->expects($this->once())
            ->method('persist')
            ->with($user);

        $manager->save($user);
    }
}
