<?php


namespace Paroki\Referensi\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Paroki\User\Entity\User;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Gedmo\Mapping\Annotation as Gedmo;

#[ApiResource()]
#[ORM\Entity()]
#[ORM\Table(name: 'ref_paroki')]
class Paroki
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME)]
    private ?string $id = null;

    #[ORM\Column(type: 'string', length: 7, unique: true)]
    private ?string $kode = null;

    #[ORM\ManyToOne(
        targetEntity: Keuskupan::class
    )]
    private Keuskupan $keuskupan;

    #[ORM\Column(type: 'integer')]
    private int $nomor = 0;

    #[ORM\Column(length: 100)]
    private ?string $nama = null;

    #[ORM\Column(length: 100)]
    private ?string $gereja = null;

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
    private ?string $pastorParoki = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $wilayahKeuskupan = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Gedmo\Timestampable()]
    private \DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $updatedBy = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getKode(): ?string
    {
        return $this->kode;
    }

    /**
     * @param string|null $kode
     * @return Paroki
     */
    public function setKode(?string $kode): Paroki
    {
        $this->kode = $kode;
        return $this;
    }


    /**
     * @return int
     */
    public function getNomor(): int
    {
        return $this->nomor;
    }

    /**
     * @param int $nomor
     * @return Paroki
     */
    public function setNomor(int $nomor): Paroki
    {
        $this->nomor = $nomor;
        return $this;
    }

    /**
     * @return Keuskupan
     */
    public function getKeuskupan(): Keuskupan
    {
        return $this->keuskupan;
    }

    /**
     * @param Keuskupan $keuskupan
     * @return Paroki
     */
    public function setKeuskupan(Keuskupan $keuskupan): Paroki
    {
        $this->keuskupan = $keuskupan;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNama(): ?string
    {
        return $this->nama;
    }

    /**
     * @param string|null $nama
     * @return Paroki
     */
    public function setNama(?string $nama): Paroki
    {
        $this->nama = $nama;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGereja(): ?string
    {
        return $this->gereja;
    }

    /**
     * @param string|null $gereja
     * @return Paroki
     */
    public function setGereja(?string $gereja): Paroki
    {
        $this->gereja = $gereja;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAlamat(): ?string
    {
        return $this->alamat;
    }

    /**
     * @param string|null $alamat
     * @return Paroki
     */
    public function setAlamat(?string $alamat): Paroki
    {
        $this->alamat = $alamat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKota(): ?string
    {
        return $this->kota;
    }

    /**
     * @param string|null $kota
     * @return Paroki
     */
    public function setKota(?string $kota): Paroki
    {
        $this->kota = $kota;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelepon(): ?string
    {
        return $this->telepon;
    }

    /**
     * @param string|null $telepon
     * @return Paroki
     */
    public function setTelepon(?string $telepon): Paroki
    {
        $this->telepon = $telepon;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * @return Paroki
     */
    public function setFax(?string $fax): Paroki
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * @return Paroki
     */
    public function setWebsite(?string $website): Paroki
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Paroki
     */
    public function setEmail(?string $email): Paroki
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPastorParoki(): ?string
    {
        return $this->pastorParoki;
    }

    /**
     * @param string|null $pastorParoki
     * @return Paroki
     */
    public function setPastorParoki(?string $pastorParoki): Paroki
    {
        $this->pastorParoki = $pastorParoki;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWilayahKeuskupan(): ?string
    {
        return $this->wilayahKeuskupan;
    }

    /**
     * @param string|null $wilayahKeuskupan
     * @return Paroki
     */
    public function setWilayahKeuskupan(?string $wilayahKeuskupan): Paroki
    {
        $this->wilayahKeuskupan = $wilayahKeuskupan;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     * @return Paroki
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): Paroki
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    /**
     * @param User|null $updatedBy
     * @return Paroki
     */
    public function setUpdatedBy(?User $updatedBy): Paroki
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}