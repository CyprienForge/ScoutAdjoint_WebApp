<?php

namespace Domain\UseCase\FetchMatchs;

use Domain\Response\FetchMatchs\FetchMatchsResponse;

interface FetchMatchsOutputBoundary
{
    public function present(FetchMatchsResponse $response) : void;
}
