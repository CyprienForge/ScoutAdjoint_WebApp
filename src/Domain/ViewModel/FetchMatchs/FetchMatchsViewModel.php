<?php

namespace Domain\ViewModel\FetchMatchs;

use Domain\ViewModel\Entity\MatchViewModel;

class FetchMatchsViewModel
{
    public array $matchsViewModels;
    public function getMatchsViewModels(): array
    {
        return $this->matchsViewModels;
    }

}
