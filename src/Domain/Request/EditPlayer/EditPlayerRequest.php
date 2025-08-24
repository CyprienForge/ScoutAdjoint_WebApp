<?php

namespace Domain\Request\EditPlayer;

use Domain\Dto\EditPlayer\EditPlayerDTO;
use Domain\Dto\EditPlayer\ImagePlayerDTO;
use Domain\Entity\Team;

class EditPlayerRequest
{

    public function __construct(
        public EditPlayerDTO $editPlayerDTO,
    ){}

}
