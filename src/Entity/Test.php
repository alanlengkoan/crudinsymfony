<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nama;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $jenkel;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $alamat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNama(): ?string
    {
        return $this->nama;
    }

    public function setNama(string $nama): self
    {
        $this->nama = $nama;

        return $this;
    }

    public function getJenkel(): ?string
    {
        return $this->jenkel;
    }

    public function setJenkel(string $jenkel): self
    {
        $this->jenkel = $jenkel;

        return $this;
    }

    public function getAlamat(): ?string
    {
        return $this->alamat;
    }

    public function setAlamat(string $alamat): self
    {
        $this->alamat = $alamat;

        return $this;
    }
}
