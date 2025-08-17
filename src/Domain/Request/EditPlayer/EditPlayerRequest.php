<?php

namespace Domain\Request\EditPlayer;

use Domain\Dto\EditPlayer\ImagePlayerDTO;
use Domain\Entity\Team;

class EditPlayerRequest
{

    public function __construct(
        public int $idPlayer,
        public string $newFirstName,
        public string $newLastName,
        public \DateTime $newBirthDate,
        public Team $newTeam,
        public ?ImagePlayerDTO $newImage
    ){}

}
