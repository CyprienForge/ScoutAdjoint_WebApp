<?php

namespace Application\Command\MergePlayers;

use Domain\Request\MergePlayers\MergePlayersRequest;
use Domain\Response\MergePlayers\MergePlayersResponse;

class MergePlayersCommand
{

    public function execute(MergePlayersRequest $request) : MergePlayersResponse
    {
        return new MergePlayersResponse();
    }

}
