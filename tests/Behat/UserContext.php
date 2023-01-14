<?php


namespace Paroki\Tests\Behat;


use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\JsonContext;
use Behatch\Context\RestContext;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Paroki\Tests\Behat\Concern\Doctrine;
use Paroki\Tests\Behat\Concern\ServiceManager;
use Paroki\User\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserContext implements Context
{
    use ServiceManager, Doctrine;

    private UserPasswordHasherInterface $hasher;
    private RestContext $restContext;
    private JsonContext $jsonContext;
    private JWTTokenManagerInterface $jwt;
    private UrlGeneratorInterface $router;

    public function __construct(
        KernelInterface $kernel,
        UserPasswordHasherInterface $hasher,
        JWTTokenManagerInterface $jwt,
        UrlGeneratorInterface $router
    ){
        $this->setKernel($kernel);
        $this->hasher = $hasher;
        $this->jwt = $jwt;
        $this->router = $router;
    }

    /**
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $env = $scope->getEnvironment();

        $this->restContext = $env->getContext(RestContext::class);
        $this->jsonContext = $env->getContext(JsonContext::class);
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
     * @Given I don't have user with email :email
     */
    public function iDonTHaveUserWith(string $email)
    {
        $user = $this->findByEmail($email);

        if(!is_null($user)){
            $this->remove($user);
        }
    }

    /**
     * @Given I have user with email :email and password :password
     * @Given I have user with email :email
     */
    public function iHaveUserWith(string $email, string $password='password', array $roles = ['ROLE_USER']): User
    {
        $user = $this->getUserRepository()->findOneBy([
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

    public function iLoggedInWith($user)
    {
        $rest = $this->restContext;
        $jwt = $this->jwt;

        $token = $jwt->create($user);
        $rest->iAddHeaderEqualTo('Authorization', 'Bearer '.$token);
    }

    /**
     * @Given I have logged in as paroki admin
     */
    public function iHaveLoggedInAsAdmin()
    {
        $email = 'admin@example.com';
        $password = 'password';
        $user = $this->iHaveUserWith($email, $password, [User::ROLE_PAROKI_ADMIN]);
        $this->iLoggedInWith($user);
    }

    /**
     * @Given I send a :method request for user :email
     */
    public function iSendARequestForUser(string $method, string $email, ?PyStringNode $body = null)
    {
        $user = $this->findByEmail($email);
        $rest = $this->restContext;
        $url = '/users/'.$user->getId();

        $rest->iSendARequestTo($method, $url, $body);
    }

    public function getUserRepository(): EntityRepository
    {
        return $this->getEntityManager()->getRepository(User::class);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->getUserRepository()->findOneBy(['email' => $email]);
    }
}