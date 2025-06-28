<?php

namespace Domain\Request\FetchPlayers;

use DateTime;

class FetchPlayersRequest
{
    public function __construct(
      public int $limit = 15,
      public int $offset = 0,
      public string $pageNumber,
      public ?string $firstNameSearch,
      public ?string $lastNameSearch,
      public ?DateTime $startBirthDate,
      public ?DateTime $endBirthDate,
    ){}
}
