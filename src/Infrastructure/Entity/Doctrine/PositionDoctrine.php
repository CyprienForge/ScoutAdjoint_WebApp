<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Infrastructure\Repository\Doctrine\PositionRepositoryDoctrine;

#[ORM\Entity(repositoryClass: PositionRepositoryDoctrine::class)]
#[Table(name: 'positions')]
class PositionDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, PlacementDoctrine>
     */
    #[ORM\OneToMany(targetEntity: PlacementDoctrine::class, mappedBy: 'position')]
    private Collection $placementDoctrines;

    public function __construct()
    {
        $this->placementDoctrines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, PlacementDoctrine>
     */
    public function getPlacementDoctrines(): Collection
    {
        return $this->placementDoctrines;
    }

    public function addPlacementDoctrine(PlacementDoctrine $placementDoctrine): static
    {
        if (!$this->placementDoctrines->contains($placementDoctrine)) {
            $this->placementDoctrines->add($placementDoctrine);
            $placementDoctrine->addPosition($this);
        }

        return $this;
    }

    public function removePlacementDoctrine(PlacementDoctrine $placementDoctrine): static
    {
        if ($this->placementDoctrines->removeElement($placementDoctrine)) {
            $placementDoctrine->removePosition($this);
        }

        return $this;
    }
}
