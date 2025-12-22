<?php

namespace Domain\Presenter\ListMatchInfos;

use Domain\Response\ListMatchInfos\ListMatchInfosResponse;

interface ListMatchInfosPresenter
{
    public function present(ListMatchInfosResponse $response) : void;
    public function getPresentation();
}
