<?php

namespace Domain\UseCase\FetchData;

use Domain\Repository\ChampionshipRepository;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Domain\Request\FetchData\FetchDataRequest;
use Domain\Response\FetchData\FetchDataResponse;
use Infrastructure\Entity\Doctrine\Mapper\ChampionshipMapperDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\PlayerMapperDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\TeamMapperDoctrine;

class FetchDataUseCase
{

    public function __construct(
        private ChampionshipRepository $readChampionshipRepository,
        private ChampionshipRepository $writeChampionshipRepository,
        private TeamRepository $readTeamRepository,
        private TeamRepository $writeTeamRepository,
        private PlayerRepository $readPlayerRepository,
        private PlayerRepository $writePlayerRepository
    ){}

    public function execute(FetchDataRequest $request) : FetchDataResponse
    {
        $championships = $this->readChampionshipRepository->findAll();
        $teams = $this->readTeamRepository->findAll();
        $players = $this->readPlayerRepository->findAll();

        $this->writePlayerRepository->deleteAll();
        $this->writeTeamRepository->deleteAll();
        $this->writeChampionshipRepository->deleteAll();

        foreach ($championships as $championship) {
            $championship = ChampionshipMapperDoctrine::toInfra($championship);
            $this->writeChampionshipRepository->save($championship);
        }

        foreach($teams as $team){
            $team = TeamMapperDoctrine::toInfra($team);
            $localChampionship = $this->writeChampionshipRepository->findByIdentificationCode($team->getChampionship()->getIdentificationCode());
            $team->setChampionship($localChampionship);
            $this->writeTeamRepository->save($team);
        }

        foreach($players as $player){
            $player = PlayerMapperDoctrine::toInfra($player);
            $localTeam = $this->writeTeamRepository->findByIdentificationCode($player->getTeam()->getIdentificationCode());
            $player->setTeam($localTeam);
            $this->writePlayerRepository->save($player);
        }

        return new FetchDataResponse();
    }

}
