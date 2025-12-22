<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\ShowDetailsMatch\ShowDetailsMatchPresenter;
use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;
use Infrastructure\Json\Dto\ShowDetailsMatchJsonDto;

class ShowDetailsMatchJsonPresenter implements ShowDetailsMatchPresenter
{
    private array $result = [];

    public function present(ShowDetailsMatchResponse $response)
    {
        foreach($response->participationsNotes as $participationNote){
            $showDetailsJsonDto = new ShowDetailsMatchJsonDto();

            $this->result[] = $showDetailsJsonDto->toDto($participationNote);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
