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
        private ChampionshipMapper $championshipMapper
    ){}

    public function execute(ListChampionshipsRequest $listChampionshipsRequest) : ListChampionshipsResponse
    {
        $championshipsInfra = $this->championshipRepository->findAll();
        $championships = [];

        foreach ($championshipsInfra as $championship){
            $championships[] = $this->championshipMapper->toDomain($championship);
        }

        return new ListChampionshipsResponse($championships);
    }

}
