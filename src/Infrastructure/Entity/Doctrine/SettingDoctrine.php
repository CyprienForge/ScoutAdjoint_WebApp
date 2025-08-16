<?php

namespace Infrastructure\Entity\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Repository\Doctrine\SettingRepositoryDoctrine;

#[ORM\Entity(repositoryClass: SettingRepositoryDoctrine::class)]
#[ORM\Table(name: "settings")]
class SettingDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\Column(length: 255)]
    private ?string $id_txt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getIdTxt(): ?string
    {
        return $this->id_txt;
    }

    public function setIdTxt(string $id_txt): static
    {
        $this->id_txt = $id_txt;

        return $this;
    }
}
