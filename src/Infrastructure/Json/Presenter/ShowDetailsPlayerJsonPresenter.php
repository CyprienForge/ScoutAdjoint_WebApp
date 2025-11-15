<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\ShowDetailsPlayer\ShowDetailsPlayerPresenter;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;
use Domain\Service\Serializer;
use Infrastructure\Json\Dto\PlayerJsonDto;

class ShowDetailsPlayerJsonPresenter implements ShowDetailsPlayerPresenter
{
    private PlayerJsonDto $result;

    public function present(ShowDetailsPlayerResponse $response): void
    {
        $playerDto = new PlayerJsonDto();
        $this->result = $playerDto->toDto($response->player);
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
