<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\FetchPositionsByPlayer\FetchPositionsByPlayerPresenter;
use Domain\Response\FetchPositionsByPlayer\FetchPositionsByPlayerResponse;
use Infrastructure\Json\Dto\PositionJsonDto;

class FetchPositionsByPlayerJsonPresenter implements FetchPositionsByPlayerPresenter
{
    private array $result = [];

    public function present(FetchPositionsByPlayerResponse $response): void
    {
        foreach($response->positions as $position){
            $positionDto = new PositionJsonDto();
            $this->result[] = $positionDto->toDto($position);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
