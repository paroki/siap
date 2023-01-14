<?php


namespace Paroki\Core;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

trait ModelManagerTrait
{
    protected EntityManagerInterface $em;
    protected EntityRepository $repository;

    public function save(object $object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function remove(object $object)
    {
        $this->em->remove($object);
        $this->em->flush();
    }
}