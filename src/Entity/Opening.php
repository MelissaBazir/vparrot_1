<?php

namespace App\Entity;

use App\Repository\OpeningRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningRepository::class)]
class Opening
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::OBJECT)]
    private ?object $hours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHours(): ?object
    {
        return $this->hours;
    }

    public function setHours(object $hours): static
    {
        $this->hours = $hours;

        return $this;
    }
}
