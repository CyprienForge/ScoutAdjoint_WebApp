<?php

namespace Domain\Response\ListMatchInfos;

use Domain\Entity\MatchInfos;

class ListMatchInfosResponse
{
    public function __construct(
        public MatchInfos $matchInfos
    ){}
}
