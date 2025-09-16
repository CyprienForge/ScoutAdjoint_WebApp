<?php

namespace Domain\Request\ShowMerge;

class ShowMergeRequest
{
    public function __construct(
        public int $idPlayerToMerge
    ){}
}
