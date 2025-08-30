<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\ChampionshipDoctrineRepository;

#[ORM\Entity(repositoryClass: ChampionshipDoctrineRepository::class)]
#[ORM\Table(name: "championships")]
class ChampionshipDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $level = null;

    /**
     * @var Collection<int, TeamDoctrine>
     */
    #[ORM\OneToMany(targetEntity: TeamDoctrine::class, mappedBy: 'championship')]
    private Collection $teams;

    /**
     * @var Collection<int, MatchDoctrine>
     */
    #[ORM\OneToMany(targetEntity: MatchDoctrine::class, mappedBy: 'ChampionshipDoctrine')]
    private Collection $matchDoctrines;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->matchDoctrines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id) : static
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, TeamDoctrine>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(TeamDoctrine $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setChampionship($this);
        }

        return $this;
    }

    public function removeTeam(TeamDoctrine $team): static
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getChampionship() === $this) {
                $team->setChampionship(null);
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
            $matchDoctrine->setChampionship($this);
        }

        return $this;
    }

    public function removeMatchDoctrine(MatchDoctrine $matchDoctrine): static
    {
        if ($this->matchDoctrines->removeElement($matchDoctrine)) {
            // set the owning side to null (unless already changed)
            if ($matchDoctrine->getChampionship() === $this) {
                $matchDoctrine->setChampionship(null);
            }
        }

        return $this;
    }
}
