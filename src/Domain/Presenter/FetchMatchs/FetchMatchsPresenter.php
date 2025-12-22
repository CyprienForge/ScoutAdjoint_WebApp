<?php

namespace Domain\Presenter\FetchMatchs;

use Domain\Response\FetchMatchs\FetchMatchsResponse;

interface FetchMatchsPresenter
{
    public function present(FetchMatchsResponse $response) : void;
    public function getPresentation();
}
