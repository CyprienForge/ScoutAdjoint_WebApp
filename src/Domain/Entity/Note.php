<?php

namespace Domain\Entity;

class Note
{
    private int $id;
    private string $content;
    private Participation $participation;
    private int $minute;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Note
    {
        $this->id = $id;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Note
    {
        $this->content = $content;
        return $this;
    }

    public function getParticipation(): Participation
    {
        return $this->participation;
    }

    public function setParticipation(Participation $participation): Note
    {
        $this->participation = $participation;
        return $this;
    }

    public function getMinute(): int
    {
        return $this->minute;
    }

    public function setMinute(int $minute): Note
    {
        $this->minute = $minute;
        return $this;
    }
}
