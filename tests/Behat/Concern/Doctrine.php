<?php


namespace Paroki\Tests\Behat\Concern;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

trait Doctrine
{
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->getContainer()->get('doctrine.orm.default_entity_manager');
    }

    public function getRepository($class): EntityRepository
    {
        return $this->getEntityManager()->getRepository($class);
    }

    public function save(object $object): void
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush();
    }

    public function remove(object $object): void
    {
        $this->getEntityManager()->remove($object);
        $this->getEntityManager()->flush();
    }
}