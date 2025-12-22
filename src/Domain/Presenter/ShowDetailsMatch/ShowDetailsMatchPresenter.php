<?php

namespace Domain\Presenter\ShowDetailsMatch;

use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;

interface ShowDetailsMatchPresenter
{
    public function present(ShowDetailsMatchResponse $response);

    public function getPresentation();
}
