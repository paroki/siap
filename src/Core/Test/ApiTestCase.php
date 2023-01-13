<?php


namespace Paroki\Core\Test;


use ApiPlatform\Symfony\Bundle\Test\ApiTestCase as BaseApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectManager;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ApiTestCase extends BaseApiTestCase
{
    private ?string $token = null;

    use RefreshDatabaseTrait, UserTestTrait;

    public function setUp(): void
    {
        self::bootKernel();
    }

    protected function createClientWithCredentials($token = null): Client
    {
        $token = $token ?: $this->getToken();

        return static::createClient([], ['headers' => ['authorization' => 'Bearer '.$token]]);
    }

    /**
     * Use other credentials if needed.
     */
    protected function getToken(array $body = []): string
    {
        if ($this->token) {
            return $this->token;
        }

        $body = $body ?: [
            'email' => 'user@example.com',
            'password' => '$3cr3t',
        ];

        $response = static::createClient()->request('POST', '/login', [
            'body' => json_encode($body),
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent());
        $this->token = $data->token;

        return $data->token;
    }

    protected function getManager(): EntityManager
    {
        return static::$kernel->getContainer()->get('doctrine.orm.default_entity_manager');
    }

    protected function getRepository(string $class): EntityRepository
    {
        return $this->getManager()->getRepository($class);
    }

    protected function getService(string $id)
    {
        return static::$kernel->getContainer()->get($id);
    }
}