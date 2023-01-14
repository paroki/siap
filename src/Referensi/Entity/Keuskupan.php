<?php


namespace Paroki\Referensi\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    shortName: 'Keuskupan'
)]
#[ORM\Entity]
#[ORM\Table(name: 'ref_keuskupan')]
class Keuskupan
{
    #[ApiProperty(identifier: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true, nullable: true)]
    private ?string $uuid = null;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 3)]
    private ?string $id = null;

    #[ORM\Column(type: 'integer')]
    private int $nomor = 0;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $nama = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $namaLatin = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $alamat = null;

    /**
     * Kabupaten/Kota Keuskupan
     */
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $kota = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $telepon = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $fax = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $uskup = null;
}