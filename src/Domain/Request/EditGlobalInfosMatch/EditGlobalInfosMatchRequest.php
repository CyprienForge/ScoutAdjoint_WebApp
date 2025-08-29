<?php

namespace Domain\Request\EditGlobalInfosMatch;

use Domain\Dto\EditGlobalInfosMatch\EditGlobalInfosMatchDTO;

class EditGlobalInfosMatchRequest
{
    public function __construct(
        public int $idMatch,
        public ?EditGlobalInfosMatchDTO $editGlobalInfosMatchDTO,
    ){}
}
