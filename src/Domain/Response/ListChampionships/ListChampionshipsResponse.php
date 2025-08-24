<?php

namespace Domain\Response\ListChampionships;

class ListChampionshipsResponse
{

    public function __construct(
        public array $championships
    ){}

}
