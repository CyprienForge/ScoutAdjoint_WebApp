<?php

namespace Domain\Presenter\FetchPositionsByPlayer;

use Domain\Response\FetchPositionsByPlayer\FetchPositionsByPlayerResponse;

interface FetchPositionsByPlayerPresenter
{
    public function present(FetchPositionsByPlayerResponse $response) : void;

    public function getPresentation();
}
