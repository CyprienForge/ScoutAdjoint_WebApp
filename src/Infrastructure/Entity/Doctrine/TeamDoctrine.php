<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\TeamDoctrineRepository;

#[ORM\Entity(repositoryClass: TeamDoctrineRepository::class)]
#[ORM\Table(name: "Team")]
class TeamDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoPath = null;

    #[ORM\ManyToOne(inversedBy: 'teams')]
    private ?ChampionshipDoctrine $championship = null;

    /**
     * @var Collection<int, PlayerDoctrine>
     */
    #[ORM\OneToMany(targetEntity: PlayerDoctrine::class, mappedBy: 'team')]
    private Collection $playerDoctrines;

    #[ORM\Column(length: 255)]
    private ?string $identificationCode = null;

    public function __construct()
    {
        $this->playerDoctrines = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): static
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getChampionship(): ?ChampionshipDoctrine
    {
        return $this->championship;
    }

    public function setChampionship(?ChampionshipDoctrine $championship): static
    {
        $this->championship = $championship;

        return $this;
    }

    /**
     * @return Collection<int, PlayerDoctrine>
     */
    public function getPlayerDoctrines(): Collection
    {
        return $this->playerDoctrines;
    }

    public function addPlayerDoctrine(PlayerDoctrine $playerDoctrine): static
    {
        if (!$this->playerDoctrines->contains($playerDoctrine)) {
            $this->playerDoctrines->add($playerDoctrine);
            $playerDoctrine->setTeam($this);
        }

        return $this;
    }

    public function removePlayerDoctrine(PlayerDoctrine $playerDoctrine): static
    {
        if ($this->playerDoctrines->removeElement($playerDoctrine)) {
            // set the owning side to null (unless already changed)
            if ($playerDoctrine->getTeam() === $this) {
                $playerDoctrine->setTeam(null);
            }
        }

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
