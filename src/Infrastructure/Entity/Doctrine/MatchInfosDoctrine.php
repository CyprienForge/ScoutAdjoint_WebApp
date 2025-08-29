<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\MatchInfosDoctrineRepository;

#[ORM\Entity(repositoryClass: MatchInfosDoctrineRepository::class)]
#[ORM\Table(name: "match_infos")]
class MatchInfosDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "pre_match_info", length: 2000)]
    private ?string $preMatchInfo = null;

    #[ORM\Column(name: "post_match_info", length: 2000)]
    private ?string $postMatchInfo = null;

    #[ORM\Column(name: "home_team_info", length: 2000)]
    private ?string $homeTeamInfo = null;

    #[ORM\Column(name: "away_team_info", length: 2000)]
    private ?string $awayTeamInfo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "match", referencedColumnName: "id")]
    private ?MatchDoctrine $match = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getPreMatchInfo(): ?string
    {
        return $this->preMatchInfo;
    }

    public function setPreMatchInfo(string $preMatchInfo): static
    {
        $this->preMatchInfo = $preMatchInfo;

        return $this;
    }

    public function getPostMatchInfo(): ?string
    {
        return $this->postMatchInfo;
    }

    public function setPostMatchInfo(string $postMatchInfo): static
    {
        $this->postMatchInfo = $postMatchInfo;

        return $this;
    }

    public function getHomeTeamInfo(): ?string
    {
        return $this->homeTeamInfo;
    }

    public function setHomeTeamInfo(string $homeTeamInfo): static
    {
        $this->homeTeamInfo = $homeTeamInfo;

        return $this;
    }

    public function getAwayTeamInfo(): ?string
    {
        return $this->awayTeamInfo;
    }

    public function setAwayTeamInfo(string $awayTeamInfo): static
    {
        $this->awayTeamInfo = $awayTeamInfo;

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
}
