<?php

namespace Domain\Presenter\ShowDetailsPlayer;

use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

interface ShowDetailsPlayerPresenter
{
    public function present(ShowDetailsPlayerResponse $response) : void;
    public function getPresentation();
}
