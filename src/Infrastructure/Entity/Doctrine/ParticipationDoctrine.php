<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\ParticipationRepositoryDoctrine;

#[ORM\Entity(repositoryClass: ParticipationRepositoryDoctrine::class)]
#[ORM\Table(name: "participations")]
class ParticipationDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(name: "player", referencedColumnName: "id")]
    private ?PlayerDoctrine $player = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(name: "match", referencedColumnName: "id")]
    private ?MatchDoctrine $match = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(name: "team", referencedColumnName: "id")]
    private ?TeamDoctrine $team = null;

    /**
     * @var Collection<int, NoteDoctrine>
     */
    #[ORM\OneToMany(targetEntity: NoteDoctrine::class, mappedBy: 'participation')]
    private Collection $noteDoctrines;

    public function __construct()
    {
        $this->noteDoctrines = new ArrayCollection();
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

    /**
     * @return Collection<int, NoteDoctrine>
     */
    public function getNoteDoctrines(): Collection
    {
        return $this->noteDoctrines;
    }

    public function addNoteDoctrine(NoteDoctrine $noteDoctrine): static
    {
        if (!$this->noteDoctrines->contains($noteDoctrine)) {
            $this->noteDoctrines->add($noteDoctrine);
            $noteDoctrine->setParticipation($this);
        }

        return $this;
    }

    public function removeNoteDoctrine(NoteDoctrine $noteDoctrine): static
    {
        if ($this->noteDoctrines->removeElement($noteDoctrine)) {
            // set the owning side to null (unless already changed)
            if ($noteDoctrine->getParticipation() === $this) {
                $noteDoctrine->setParticipation(null);
            }
        }

        return $this;
    }
}
