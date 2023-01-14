<?php


namespace Paroki\Referensi;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Paroki\Core\ModelManagerTrait;
use Paroki\Referensi\Entity\Keuskupan;

class KeuskupanManager
{
    use ModelManagerTrait;

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

    public function findByKode(string $kode): ?Keuskupan
    {
        return $this->repository->findOneBy(['kode' => $kode]);
    }
}