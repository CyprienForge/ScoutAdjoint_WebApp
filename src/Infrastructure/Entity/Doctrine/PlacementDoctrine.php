<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\PlacementRepositoryDoctrine;

#[ORM\Entity(repositoryClass: PlacementRepositoryDoctrine::class)]
#[ORM\Table(name: 'placements')]
class PlacementDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PlayerDoctrine::class, inversedBy: 'placements')]
    #[ORM\JoinColumn(name: "player", referencedColumnName: "id", nullable: false)]
    private ?PlayerDoctrine $player = null;

    #[ORM\ManyToOne(targetEntity: PositionDoctrine::class, inversedBy: 'placements')]
    #[ORM\JoinColumn(name: "position", referencedColumnName: "id", nullable: false)]
    private ?PositionDoctrine $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?PlayerDoctrine
    {
        return $this->player;
    }

    public function setPlayer(?PlayerDoctrine $player): self
    {
        $this->player = $player;
        return $this;
    }

    public function getPosition(): ?PositionDoctrine
    {
        return $this->position;
    }

    public function setPosition(?PositionDoctrine $position): self
    {
        $this->position = $position;
        return $this;
    }
}
