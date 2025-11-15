<?php

namespace Application\Query\ShowMergeInfos;

use Domain\Response\ShowMerge\ShowMergeResponse;

interface ShowMergeOutputBoundary
{
    public function present(ShowMergeResponse $response);
    public function getViewModel();
}
