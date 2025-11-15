<?php

namespace Domain\Presenter\ShowMergeInfos;

use Application\Query\ShowMergeInfos\ShowMergeOutputBoundary;
use Domain\Response\ShowMerge\ShowMergeResponse;
use Domain\ViewModel\Entity\PlayerViewModel;
use Domain\ViewModel\ShowMergeInfos\PlayerMergeViewModel;
use Domain\ViewModel\ShowMergeInfos\ShowMergeViewModel;

class ShowMergeInfosPresenter implements ShowMergeOutputBoundary
{
    private ShowMergeViewModel $showMergeViewModel;

    public function present(ShowMergeResponse $response)
    {
        $this->showMergeViewModel = new ShowMergeViewModel();
        $this->showMergeViewModel->playerViewModel = new PlayerMergeViewModel(
            $response->playerToMerge->getId(),
            $response->playerToMerge->getFirstName(),
            $response->playerToMerge->getLastName(),
        );
    }

    public function getViewModel()
    {
        return $this->showMergeViewModel;
    }
}
