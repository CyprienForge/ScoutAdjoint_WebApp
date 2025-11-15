<?php

namespace Application\Query\ShowMergeInfos;

use Domain\Repository\Player\PlayerReadRepository;
use Domain\Request\ShowMerge\ShowMergeRequest;
use Domain\Response\ShowMerge\ShowMergeResponse;

class ShowMergeQuery
{
    public function __construct(
        private PlayerReadRepository $playerReadRepository,
        private ShowMergeOutputBoundary $presenter
    ){}

    public function execute(ShowMergeRequest $showMergeRequest) : ShowMergeResponse
    {
        $playerToMerge = $this->playerReadRepository->findById($showMergeRequest->idPlayerToMerge);
        $response = new ShowMergeResponse($playerToMerge);
        $this->presenter->present($response);

        return $response;
    }

}
