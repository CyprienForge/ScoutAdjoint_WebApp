<?php

namespace Domain\Request\ListMatchInfos;

class ListMatchInfosRequest
{
    public function __construct(
        public int $idMatch
    ){}
}
