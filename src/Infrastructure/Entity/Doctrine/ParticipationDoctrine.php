<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\ParticipationRepositoryDoctrine;

#[ORM\Entity(repositoryClass: ParticipationRepositoryDoctrine::class)]
#[ORM\Table(name: "Participation")]
class ParticipationDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlayerDoctrine $player = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MatchDoctrine $match = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TeamDoctrine $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getPlayer(): ?PlayerDoctrine
    {
        return $this->player;
    }

    public function setPlayer(?PlayerDoctrine $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getMatch(): ?MatchDoctrine
    {
        return $this->match;
    }

    public function setMatch(?MatchDoctrine $match): static
    {
        $this->match = $match;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

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
}
