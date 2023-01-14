<?php


namespace Paroki\Referensi;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Paroki\Referensi\Entity\Keuskupan;

class KeuskupanManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Keuskupan::class);
    }

    public function findByNama(string $nama): ?Keuskupan
    {
        return $this->repository->findOneBy(['nama' => $nama]);
    }

    public function save(object $object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function remove($keuskupan)
    {
        $this->em->remove($keuskupan);
        $this->em->flush();
    }
}