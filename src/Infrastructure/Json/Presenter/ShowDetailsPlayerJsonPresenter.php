<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\ShowDetailsPlayer\ShowDetailsPlayerPresenter;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;
use Domain\Service\Serializer;
use Infrastructure\Json\Dto\ParticipationJsonDto;
use Infrastructure\Json\Dto\PlayerJsonDto;

class ShowDetailsPlayerJsonPresenter implements ShowDetailsPlayerPresenter
{
    private array $result = [];

    public function present(ShowDetailsPlayerResponse $response): void
    {
        $playerDto = new PlayerJsonDto();
        $this->result['player'] = $playerDto->toDto($response->player);

        foreach($response->participations as $participation){
            $participationDto = new ParticipationJsonDto();
            $this->result['participations'][] = $participationDto->toDto($participation);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
