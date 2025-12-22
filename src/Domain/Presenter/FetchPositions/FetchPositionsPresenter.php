<?php

namespace Domain\Presenter\FetchPositions;

use Domain\Response\FetchPositions\FetchPositionsResponse;

interface FetchPositionsPresenter
{
    public function present(FetchPositionsResponse $response) : void;

    public function getPresentation();
}
