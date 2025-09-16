<?php

namespace Application\Query\ListChampionships;

use Domain\Mapper\ChampionshipMapper;
use Domain\Repository\Championship\ChampionshipReadRepository;
use Domain\Request\ListChampionships\ListChampionshipsRequest;
use Domain\Response\ListChampionships\ListChampionshipsResponse;

class ListChampionshipsQuery
{

    public function __construct(
        private ChampionshipReadRepository $championshipRepository,
    ){}

    public function execute(ListChampionshipsRequest $listChampionshipsRequest) : ListChampionshipsResponse
    {
        $championships = $this->championshipRepository->findAll();
        return new ListChampionshipsResponse($championships);
    }

}
