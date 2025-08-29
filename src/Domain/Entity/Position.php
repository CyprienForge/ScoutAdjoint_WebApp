<?php

namespace Domain\Entity;

class Position
{
    private int $id;
    private string $libelle;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Position
    {
        $this->id = $id;
        return $this;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): Position
    {
        $this->libelle = $libelle;
        return $this;
    }

}
