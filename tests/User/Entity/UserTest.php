<?php

namespace Paroki\Tests\User\Entity;

use Paroki\Core\Test\ApiTestCase;
use Paroki\User\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends ApiTestCase
{
    public function testGetUsers()
    {
        $response = $this->createClientAsUser()->request('GET', '/users');
        $this->assertJsonContains(['hydra:totalItems'=> 2]);
        $this->assertResponseIsSuccessful();
    }

    public function testCreateUser()
    {
        $response = $this->createClientAsUser()->request('POST', '/users', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'email' => 'test@example.com',
                'plainPassword' => 'password'
            ])
        ]);
        $this->assertResponseIsSuccessful();
    }
}
