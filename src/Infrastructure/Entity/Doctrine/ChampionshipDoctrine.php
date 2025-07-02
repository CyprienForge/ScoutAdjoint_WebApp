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

    #[ORM\Column(name: "identification_code", length: 255)]
    private ?string $identificationCode = null;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
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
