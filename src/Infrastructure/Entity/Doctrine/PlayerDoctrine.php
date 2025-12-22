<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\Player\PlayerReadRepositoryDoctrine;

#[ORM\Entity(repositoryClass: PlayerReadRepositoryDoctrine::class)]
#[ORM\Table(name: "players")]
class PlayerDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "first_name", length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(name: "last_name", length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(name: "birth_date")]
    private ?\DateTime $birthDate = null;

    #[ORM\ManyToOne(inversedBy: 'playerDoctrines')]
    #[ORM\JoinColumn(name: "team", referencedColumnName: "id")]
    private ?TeamDoctrine $team = null;
    /**
     * @var Collection<int, ParticipationDoctrine>
     */
    #[ORM\OneToMany(targetEntity: ParticipationDoctrine::class, mappedBy: 'player')]
    private Collection $participationDoctrines;

    /**
     * @var Collection<int, PlacementDoctrine>
     */
    #[ORM\OneToMany(targetEntity: PlacementDoctrine::class, mappedBy: 'player')]
    private Collection $placementDoctrines;

    #[ORM\Column(name: 'transfermarkt_url', length: 255, nullable: true)]
    private ?string $transfermarktUrl = null;

    #[ORM\Column(length: 5000, name: 'general_note', nullable: true)]
    private ?string $generalNote = null;

    public function __construct()
    {
        $this->participationDoctrines = new ArrayCollection();
        $this->placementDoctrines = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ParticipationDoctrine>
     */
    public function getParticipationDoctrines(): Collection
    {
        return $this->participationDoctrines;
    }

    public function addParticipationDoctrine(ParticipationDoctrine $participationDoctrine): static
    {
        if (!$this->participationDoctrines->contains($participationDoctrine)) {
            $this->participationDoctrines->add($participationDoctrine);
            $participationDoctrine->setPlayer($this);
        }

        return $this;
    }

    public function removeParticipationDoctrine(ParticipationDoctrine $participationDoctrine): static
    {
        if ($this->participationDoctrines->removeElement($participationDoctrine)) {
            // set the owning side to null (unless already changed)
            if ($participationDoctrine->getPlayer() === $this) {
                $participationDoctrine->setPlayer(null);
            }
        }

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
            $placementDoctrine->addPlayer($this);
        }

        return $this;
    }

    public function removePlacementDoctrine(PlacementDoctrine $placementDoctrine): static
    {
        if ($this->placementDoctrines->removeElement($placementDoctrine)) {
            $placementDoctrine->removePlayer($this);
        }

        return $this;
    }

    public function getTransfermarktUrl(): ?string
    {
        return $this->transfermarktUrl;
    }

    public function setTransfermarktUrl(?string $transfermarktUrl): static
    {
        $this->transfermarktUrl = $transfermarktUrl;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getFirstName() . " " . $this->getLastName();
    }

    public function getGeneralNote(): ?string
    {
        return $this->generalNote;
    }

    public function setGeneralNote(string $generalNote): static
    {
        $this->generalNote = $generalNote;

        return $this;
    }
}
