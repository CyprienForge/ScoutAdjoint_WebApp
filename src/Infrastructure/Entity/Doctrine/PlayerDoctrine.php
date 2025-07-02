<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\PlayerDoctrineRepository;

#[ORM\Entity(repositoryClass: PlayerDoctrineRepository::class)]
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

    #[ORM\Column(name: "identification_code", length: 255)]
    private ?string $identificationCode = null;

    /**
     * @var Collection<int, ParticipationDoctrine>
     */
    #[ORM\OneToMany(targetEntity: ParticipationDoctrine::class, mappedBy: 'player')]
    private Collection $participationDoctrines;

    public function __construct()
    {
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

    public function getIdentificationCode(): ?string
    {
        return $this->identificationCode;
    }

    public function setIdentificationCode(string $identificationCode): static
    {
        $this->identificationCode = $identificationCode;

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
}
