<?php

namespace Application\Command\FillSquadTransfermarkt;

use Domain\Request\FillSquadTransfermarkt\FillSquadTransfermarktRequest;
use Domain\Response\FillSquadTransfermarkt\FillSquadTransfermarktResponse;

class FillSquadTransfermarktCommand
{
    public function execute(FillSquadTransfermarktRequest $request) : FillSquadTransfermarktResponse
    {
        dd('ici');
        return new FillSquadTransfermarktResponse();
    }
}
