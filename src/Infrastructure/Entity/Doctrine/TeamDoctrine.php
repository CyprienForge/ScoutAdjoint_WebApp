<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\TeamDoctrineRepository;
use Infrastructure\Repository\Doctrine\TeamRepositoryDoctrine;

#[ORM\Entity(repositoryClass: TeamRepositoryDoctrine::class)]
#[ORM\Table(name: "teams")]
class TeamDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: "logo_path", length: 255, nullable: true)]
    private ?string $logoPath = null;

    #[ORM\ManyToOne(inversedBy: 'teams')]
    #[ORM\JoinColumn(name: "championship", referencedColumnName: "id")]
    private ?ChampionshipDoctrine $championship = null;

    /**
     * @var Collection<int, PlayerDoctrine>
     */
    #[ORM\OneToMany(targetEntity: PlayerDoctrine::class, mappedBy: 'team')]
    private Collection $playerDoctrines;

    /**
     * @var Collection<int, MatchDoctrine>
     */
    #[ORM\OneToMany(targetEntity: MatchDoctrine::class, mappedBy: 'homeTeam')]
    private Collection $matchDoctrines;

    /**
     * @var Collection<int, ParticipationDoctrine>
     */
    #[ORM\OneToMany(targetEntity: ParticipationDoctrine::class, mappedBy: 'team')]
    private Collection $participationDoctrines;

    public function __construct()
    {
        $this->playerDoctrines = new ArrayCollection();
        $this->matchDoctrines = new ArrayCollection();
        $this->participationDoctrines = new ArrayCollection();
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

    /**
     * @return Collection<int, MatchDoctrine>
     */
    public function getMatchDoctrines(): Collection
    {
        return $this->matchDoctrines;
    }

    public function addMatchDoctrine(MatchDoctrine $matchDoctrine): static
    {
        if (!$this->matchDoctrines->contains($matchDoctrine)) {
            $this->matchDoctrines->add($matchDoctrine);
            $matchDoctrine->setHomeTeam($this);
        }

        return $this;
    }

    public function removeMatchDoctrine(MatchDoctrine $matchDoctrine): static
    {
        if ($this->matchDoctrines->removeElement($matchDoctrine)) {
            // set the owning side to null (unless already changed)
            if ($matchDoctrine->getHomeTeam() === $this) {
                $matchDoctrine->setHomeTeam(null);
            }
        }

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
            $participationDoctrine->setTeam($this);
        }

        return $this;
    }

    public function removeParticipationDoctrine(ParticipationDoctrine $participationDoctrine): static
    {
        if ($this->participationDoctrines->removeElement($participationDoctrine)) {
            // set the owning side to null (unless already changed)
            if ($participationDoctrine->getTeam() === $this) {
                $participationDoctrine->setTeam(null);
            }
        }

        return $this;
    }

    public function __toString() : string
    {
        return $this->getName();
    }
}
