<?php


namespace Paroki\Core\Test;


use ApiPlatform\Symfony\Bundle\Test\Client;
use Paroki\User\Entity\User;
use Paroki\User\UserManager;

trait UserTestTrait
{
    protected function ensureUserExists(string $email, string $password, array $roles = [])
    {
        /* @var \Paroki\User\UserManager $manager */
        $manager = $this->getService(UserManager::class);
        $user = $manager->findByEmail($email);
        if(!is_object($user)){
            $user = new User();
        }
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setRoles($roles);
        $manager->save($user);

        return $user;
    }

    protected function createClientAsUser(string $email = 'user@example.com', string $password='$3cr3t', array $roles=[User::ROLE_USER]): Client
    {
        $this->ensureUserExists($email, $password, $roles);

        $token = $this->getToken([
            'email' => $email,
            'password' => $password
        ]);
        return $this->createClientWithCredentials($token);
    }

    protected function createClientAsAdmin(string $email='admin@example.com', string $password='password'): Client
    {
        return $this->createClientAsUser($email, $password, [User::ROLE_SUPER_ADMIN]);
    }
}