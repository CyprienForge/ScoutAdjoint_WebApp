<?php

namespace Domain\Entity;

class Team
{
    private int $id;
    private string $name;
    private ?string $logoPath;
    private ?Championship $championship;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Team
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): Team
    {
        $this->logoPath = $logoPath;
        return $this;
    }

    public function getChampionship(): ?Championship
    {
        return $this->championship;
    }

    public function setChampionship(?Championship $championship): Team
    {
        $this->championship = $championship;
        return $this;
    }
}
