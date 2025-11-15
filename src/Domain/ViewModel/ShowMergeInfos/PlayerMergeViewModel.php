<?php

namespace Domain\ViewModel\ShowMergeInfos;

class PlayerMergeViewModel
{
    public function __construct(
        public int $idPlayerToMerge,
        public string $firstName,
        public string $lastName,
    ){}
}
