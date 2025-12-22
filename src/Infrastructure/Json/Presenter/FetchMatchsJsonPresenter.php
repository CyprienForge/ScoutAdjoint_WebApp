<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\FetchMatchs\FetchMatchsPresenter;
use Domain\Response\FetchMatchs\FetchMatchsResponse;
use Infrastructure\Json\Dto\MatchJsonDto;

class FetchMatchsJsonPresenter implements FetchMatchsPresenter
{
    private array $result = [];

    public function present(FetchMatchsResponse $response): void
    {
        foreach($response->getMatchs() as $match) {
            $matchDto = new MatchJsonDto();
            $this->result[] = $matchDto->toDto($match);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
