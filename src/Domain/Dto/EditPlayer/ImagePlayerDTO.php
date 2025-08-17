<?php

namespace Domain\Dto\EditPlayer;

class ImagePlayerDTO
{

    public function __construct(
        private string $name,
        private string $mimeType,
        private int $size
    ){}

    public function getSize(): int
    {
        return $this->size;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
