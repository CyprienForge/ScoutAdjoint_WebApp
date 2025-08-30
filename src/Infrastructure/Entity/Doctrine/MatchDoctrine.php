<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\MatchRepositoryDoctrine;

#[ORM\Entity(repositoryClass: MatchRepositoryDoctrine::class)]
#[ORM\Table(name: "matchs")]
class MatchDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\Column(name: "score_home", type: "integer")]
    private ?int $scoreHome = null;

    #[ORM\Column(name: "score_away", type: "integer")]
    private ?int $scoreAway = null;

    #[ORM\ManyToOne(inversedBy: 'homeMatches')]
    #[ORM\JoinColumn(name: "home_team", referencedColumnName: "id")]
    private ?TeamDoctrine $homeTeam = null;

    #[ORM\ManyToOne(inversedBy: 'awayMatches')]
    #[ORM\JoinColumn(name: "away_team", referencedColumnName: "id")]
    private ?TeamDoctrine $awayTeam = null;

    #[ORM\Column(name: "is_prepared", type: "boolean")]
    private ?bool $isPrepared = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $infos = null;

    #[ORM\OneToMany(targetEntity: ParticipationDoctrine::class, mappedBy: 'match')]
    private Collection $participationDoctrines;

    #[ORM\ManyToOne(targetEntity: StadiumDoctrine::class)]
    #[ORM\JoinColumn(name: "stadium", referencedColumnName: "id", nullable: true)]
    private ?StadiumDoctrine $stadium = null;

    #[ORM\ManyToOne(inversedBy: 'matchDoctrines')]
    #[ORM\JoinColumn(name: "championship", referencedColumnName: "id", nullable: true)]
    private ?ChampionshipDoctrine $ChampionshipDoctrine = null;

    public function __construct()
    {
        $this->participationDoctrines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->scoreHome;
    }

    public function setScoreHome(int $scoreHome): static
    {
        $this->scoreHome = $scoreHome;
        return $this;
    }

    public function getScoreAway(): ?int
    {
        return $this->scoreAway;
    }

    public function setScoreAway(int $scoreAway): static
    {
        $this->scoreAway = $scoreAway;
        return $this;
    }

    public function getHomeTeam(): ?TeamDoctrine
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(?TeamDoctrine $homeTeam): static
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }

    public function getAwayTeam(): ?TeamDoctrine
    {
        return $this->awayTeam;
    }

    public function setAwayTeam(?TeamDoctrine $awayTeam): static
    {
        $this->awayTeam = $awayTeam;
        return $this;
    }

    public function isPrepared(): ?bool
    {
        return $this->isPrepared;
    }

    public function setIsPrepared(bool $isPrepared): static
    {
        $this->isPrepared = $isPrepared;
        return $this;
    }

    public function getInfos(): ?string
    {
        return $this->infos;
    }

    public function setInfos(?string $infos): static
    {
        $this->infos = $infos;
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
            $participationDoctrine->setMatch($this);
        }
        return $this;
    }

    public function removeParticipationDoctrine(ParticipationDoctrine $participationDoctrine): static
    {
        if ($this->participationDoctrines->removeElement($participationDoctrine)) {
            if ($participationDoctrine->getMatch() === $this) {
                $participationDoctrine->setMatch(null);
            }
        }
        return $this;
    }

    public function getStadium(): ?StadiumDoctrine
    {
        return $this->stadium;
    }

    public function setStadium(?StadiumDoctrine $stadium): static
    {
        $this->stadium = $stadium;
        return $this;
    }

    public function getChampionship(): ?ChampionshipDoctrine
    {
        return $this->ChampionshipDoctrine;
    }

    public function setChampionship(?ChampionshipDoctrine $ChampionshipDoctrine): static
    {
        $this->ChampionshipDoctrine = $ChampionshipDoctrine;

        return $this;
    }
}
