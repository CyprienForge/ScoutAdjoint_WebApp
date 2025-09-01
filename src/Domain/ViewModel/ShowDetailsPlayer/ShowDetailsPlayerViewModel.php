<?php

namespace Domain\ViewModel\ShowDetailsPlayer;

use Domain\ViewModel\Entity\PlayerViewModel;

class ShowDetailsPlayerViewModel
{
    public string $displayTransfermarkt;
    public PlayerViewModel $playerViewModel;
    public array $participationViewModels = [];
}
