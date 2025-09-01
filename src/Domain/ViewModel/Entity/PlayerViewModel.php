<?php

namespace Domain\ViewModel\Entity;

class PlayerViewModel
{

    public function __construct(
        public int $positionLoop,
        public int $id,
        public string $firstName,
        public string $lastName,
        public string $teamName,
        public string $birthDate,
        public ?string $transfermarktUrl
    ){}

}
