<?php

namespace Domain\ViewModel\ShowDetailsPlayer;

use Domain\ViewModel\Entity\PlayerViewModel;

class ShowDetailsPlayerViewModel
{
    public PlayerViewModel $playerViewModel;
    public array $participationViewModels = [];
}
