<?php

namespace Application\Query\FetchBaseData;

use Domain\Entity\Championship;
use Domain\Mapper\ChampionshipMapper;
use Domain\Repository\ChampionshipRepository;
use Domain\Request\FetchBaseData\FetchBaseDataRequest;
use Domain\Response\FetchBaseData\FetchBaseDataResponse;
use Domain\Service\FetchBaseData\FetchBaseDataProvider;

class FetchBaseDataQuery
{
    public function __construct(
        private ChampionshipRepository $championshipRepository,
        private ChampionshipMapper  $championshipMapper,
        private FetchBaseDataProvider $fetchBaseDataProvider
    ){}

    public function execute(FetchBaseDataRequest $request): FetchBaseDataResponse
    {
        // $teams = $this->fetchBaseDataProvider->fetchTeams();
        /*
        foreach($teams as $team)
        {
            echo $team['team']['name'] . ' - ' . $team['team']['logo'] . '<br>';
        }

        dd('stop');
        */

        $championships = $this->fetchBaseDataProvider->fetchChampionships();

        foreach($championships as $championship)
        {
            $newChampionship = new Championship();
            $newChampionship->setId(0);
            $newChampionship->setName($championship['league']['name']);
            $newChampionship->setLevel(0);

            $newChampionshipInfra = $this->championshipMapper->toInfra($newChampionship);
            $this->championshipRepository->save($newChampionshipInfra);
        }

        return new FetchBaseDataResponse();
    }

}
