<?php

namespace Application\Query\ShowDetailsUser;

use Domain\Response\ShowDetailsUser\ShowDetailsUserResponse;

interface ShowDetailsUserOutputBoundary
{

    public function present(ShowDetailsUserResponse $response);
    public function getViewModel();
}
