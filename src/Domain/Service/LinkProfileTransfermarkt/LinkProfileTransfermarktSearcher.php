<?php

namespace Domain\Service\LinkProfileTransfermarkt;

use Domain\Entity\Player;

interface LinkProfileTransfermarktSearcher
{
    public function searchLinkProfileTransfermarkt(Player $player) : string;
}
