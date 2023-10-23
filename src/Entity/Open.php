<?php

namespace App\Entity;

use App\Repository\OpenRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpenRepository::class)]
class Open
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $day = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $amOpening = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $amClosure = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $pmOpening = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $pmClosure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getAmOpening(): ?int
    {
        return $this->amOpening;
    }

    public function setAmOpening(int $amOpening): static
    {
        $this->amOpening = $amOpening;

        return $this;
    }

    public function getAmClosure(): ?int
    {
        return $this->amClosure;
    }

    public function setAmClosure(int $amClosure): static
    {
        $this->amClosure = $amClosure;

        return $this;
    }

    public function getPmOpening(): ?int
    {
        return $this->pmOpening;
    }

    public function setPmOpening(int $pmOpening): static
    {
        $this->pmOpening = $pmOpening;

        return $this;
    }

    public function getPmClosure(): ?int
    {
        return $this->pmClosure;
    }

    public function setPmClosure(int $pmClosure): static
    {
        $this->pmClosure = $pmClosure;

        return $this;
    }
}
