<?php


namespace Paroki\Tests\Behat;


use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\RestContext;
use Paroki\Tests\Behat\Concern\Doctrine;
use Paroki\Tests\Behat\Concern\ServiceManager;
use Paroki\User\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class UserContext implements Context
{
    /**
     * @var KernelInterface
     */
    use ServiceManager, Doctrine;

    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $hasher;
    private RestContext $restContext;

    public function __construct(KernelInterface $kernel, UserPasswordHasherInterface $hasher)
    {
        $this->setKernel($kernel);
        $this->hasher = $hasher;
    }

    /**
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $env = $scope->getEnvironment();

        $this->restContext = $env->getContext(RestContext::class);
    }

    /**
     * @Given I am sign in with email :email and password :password
     */
    public function iAmSignInWith(string $email, string $password)
    {
        $rest = $this->restContext;
        $data = ['email' => $email, 'password' => $password];
        $body = new PyStringNode([json_encode($data)], 0);
        $rest->iAddHeaderEqualTo('Content-Type', 'application/json');
        $rest->iSendARequestToWithBody('POST', '/login', $body);
    }

    /**
     * @Given I have user with email :email and password :password
     */
    public function iHaveUserWith(string $email, string $password, array $roles = ['ROLE_USER']): User
    {
        $user = $this->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
        $hasher = $this->hasher;

        if(is_null($user)){
            $user = new User();
        }

        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setPassword($hasher->hashPassword($user, $user->getPlainPassword()));

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }


}