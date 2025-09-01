<?php

namespace Domain\UseCase\FillSquadTransfermarkt;

use Domain\Request\FillSquadTransfermarkt\FillSquadTransfermarktRequest;
use Domain\Response\FillSquadTransfermarkt\FillSquadTransfermarktResponse;

class FillSquadTransfermarktUseCase
{
    public function execute(FillSquadTransfermarktRequest $request) : FillSquadTransfermarktResponse
    {
        dd('ici');
        return new FillSquadTransfermarktResponse();
    }
}
