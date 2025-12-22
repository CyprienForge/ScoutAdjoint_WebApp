<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\ListMatchInfos\ListMatchInfosPresenter;
use Domain\Response\ListMatchInfos\ListMatchInfosResponse;
use Infrastructure\Json\Dto\MatchInfosJsonDto;

class ListMatchInfosJsonPresenter implements ListMatchInfosPresenter
{
    private $result;

    public function present(ListMatchInfosResponse $response): void
    {
        $matchInfosDto = new MatchInfosJsonDto();
        $this->result = $matchInfosDto->toDto($response->matchInfos);
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
