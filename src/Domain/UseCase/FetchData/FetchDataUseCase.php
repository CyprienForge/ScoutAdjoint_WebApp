<?php

namespace Domain\UseCase\FetchData;

use Domain\Repository\ChampionshipRepository;
use Domain\Repository\MatchRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Domain\Request\FetchData\FetchDataRequest;
use Domain\Response\FetchData\FetchDataResponse;
use Infrastructure\Entity\Doctrine\Mapper\ChampionshipMapperDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\MatchMapperDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\ParticipationMapperDoctrine;
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
        private PlayerRepository $writePlayerRepository,
        private MatchRepository $readMatchRepository,
        private MatchRepository $writeMatchRepository,
        private ParticipationRepository $readParticipationRepository,
        private ParticipationRepository $writeParticipationRepository,
    ){}

    public function execute(FetchDataRequest $request) : FetchDataResponse
    {
        $championships = $this->readChampionshipRepository->findAll();
        $teams = $this->readTeamRepository->findAll();
        $players = $this->readPlayerRepository->findAll();
        $matchs = $this->readMatchRepository->findAll();
        $participations = $this->readParticipationRepository->findAll();

        $this->writeParticipationRepository->deleteAll();
        $this->writeMatchRepository->deleteAll();
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

        foreach($matchs as $match){
            $match = MatchMapperDoctrine::toInfra($match);
            $localHomeTeam = $this->writeTeamRepository->findByIdentificationCode($match->getHomeTeam()->getIdentificationCode());
            $localAwayTeam = $this->writeTeamRepository->findByIdentificationCode($match->getAwayTeam()->getIdentificationCode());
            $match->setHomeTeam($localHomeTeam);
            $match->setAwayTeam($localAwayTeam);
            $this->writeMatchRepository->save($match);
        }

        foreach($participations as $participation){
            $participation = ParticipationMapperDoctrine::toInfra($participation);
            $player = $this->writePlayerRepository->findByIdentificationCode($participation->getPlayer()->getIdentificationCode());
            $match = $this->writeMatchRepository->findByIdentificationCode($participation->getMatch()->getIdentificationCode());
            $team = $this->writeTeamRepository->findByIdentificationCode($participation->getTeam()->getIdentificationCode());
            $participation->setMatch($match);
            $participation->setTeam($team);
            $participation->setPlayer($player);
            $this->writeParticipationRepository->save($participation);
        }

        return new FetchDataResponse();
    }

}
