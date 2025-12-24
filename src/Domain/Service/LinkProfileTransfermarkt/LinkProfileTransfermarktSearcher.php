<?php

namespace Domain\Service\LinkProfileTransfermarkt;

use Domain\Entity\Player\Player;

interface LinkProfileTransfermarktSearcher
{
    public function searchLinkProfileTransfermarkt(Player $player) : string;
}
