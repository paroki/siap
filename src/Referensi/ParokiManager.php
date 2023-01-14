<?php


namespace Paroki\Referensi;


use Doctrine\ORM\EntityManagerInterface;
use Paroki\Core\ModelManagerTrait;
use Paroki\Referensi\Entity\Keuskupan;
use Paroki\Referensi\Entity\Paroki;

class ParokiManager
{
    use ModelManagerTrait;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Paroki::class);
    }

    public function findByNama(string $nama): ?Paroki
    {
        return $this->repository->findOneBy(['nama' => $nama]);
    }
}