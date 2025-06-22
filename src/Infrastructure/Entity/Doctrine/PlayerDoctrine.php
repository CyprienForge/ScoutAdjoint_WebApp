<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\PlayerDoctrineRepository;

#[ORM\Entity(repositoryClass: PlayerDoctrineRepository::class)]
#[ORM\Table(name: "Player")]
class PlayerDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?\DateTime $birthDate = null;

    #[ORM\ManyToOne(inversedBy: 'playerDoctrines')]
    private ?TeamDoctrine $team = null;

    #[ORM\Column(length: 255)]
    private ?string $identificationCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTime $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getTeam(): ?TeamDoctrine
    {
        return $this->team;
    }

    public function setTeam(?TeamDoctrine $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function getIdentificationCode(): ?string
    {
        return $this->identificationCode;
    }

    public function setIdentificationCode(string $identificationCode): static
    {
        $this->identificationCode = $identificationCode;

        return $this;
    }
}
