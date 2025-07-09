<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\NoteRepositoryDoctrine;

#[ORM\Entity(repositoryClass: NoteRepositoryDoctrine::class)]
#[ORM\Table(name: "notes")]
class NoteDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $minute = null;

    #[ORM\ManyToOne(inversedBy: 'participationDoctrines')]
    #[ORM\JoinColumn(name: "participation", referencedColumnName: "id")]
    private ?ParticipationDoctrine $participation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getMinute(): ?int
    {
        return $this->minute;
    }

    public function setMinute(int $minute): static
    {
        $this->minute = $minute;

        return $this;
    }

    public function getParticipation(): ?ParticipationDoctrine
    {
        return $this->participation;
    }

    public function setParticipation(?ParticipationDoctrine $participation): static
    {
        $this->participation = $participation;

        return $this;
    }
}
