<?php


namespace Paroki\Referensi\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Paroki\User\Entity\User;
use Symfony\Bridge\Doctrine\Types\UuidType;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Gedmo\Mapping\Annotation as Gedmo;

#[ApiResource()]
#[ORM\Entity]
#[ORM\Table(name: 'ref_keuskupan')]
class Keuskupan
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME)]
    private ?string $id = null;

    #[ORM\Column(type: 'string', length: 3, unique: true)]
    private ?string $kode = null;

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
     * @return Keuskupan
     */
    public function setKode(?string $kode): Keuskupan
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
     * @return Keuskupan
     */
    public function setNomor(int $nomor): Keuskupan
    {
        $this->nomor = $nomor;
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
     * @return Keuskupan
     */
    public function setNama(?string $nama): Keuskupan
    {
        $this->nama = $nama;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNamaLatin(): ?string
    {
        return $this->namaLatin;
    }

    /**
     * @param string|null $namaLatin
     * @return Keuskupan
     */
    public function setNamaLatin(?string $namaLatin): Keuskupan
    {
        $this->namaLatin = $namaLatin;
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
     * @return Keuskupan
     */
    public function setAlamat(?string $alamat): Keuskupan
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
     * @return Keuskupan
     */
    public function setKota(?string $kota): Keuskupan
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
     * @return Keuskupan
     */
    public function setTelepon(?string $telepon): Keuskupan
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
     * @return Keuskupan
     */
    public function setFax(?string $fax): Keuskupan
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
     * @return Keuskupan
     */
    public function setWebsite(?string $website): Keuskupan
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
     * @return Keuskupan
     */
    public function setEmail(?string $email): Keuskupan
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUskup(): ?string
    {
        return $this->uskup;
    }

    /**
     * @param string|null $uskup
     * @return Keuskupan
     */
    public function setUskup(?string $uskup): Keuskupan
    {
        $this->uskup = $uskup;
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
     * @return Keuskupan
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): Keuskupan
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
     * @return Keuskupan
     */
    public function setUpdatedBy(?User $updatedBy): Keuskupan
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}