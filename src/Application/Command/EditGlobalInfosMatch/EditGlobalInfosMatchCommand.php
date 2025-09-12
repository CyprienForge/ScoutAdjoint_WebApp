<?php

namespace Application\Command\EditGlobalInfosMatch;

use Domain\Mapper\MatchInfosMapper;
use Domain\Mapper\MatchMapper;
use Domain\Repository\MatchInfosRepository;
use Domain\Repository\MatchRepository;
use Domain\Request\EditGlobalInfosMatch\EditGlobalInfosMatchRequest;
use Domain\Response\EditGlobalInfosMatch\EditGlobalInfosMatchResponse;

class EditGlobalInfosMatchCommand
{
    public function __construct(
        private MatchRepository $matchRepository,
        private MatchInfosRepository $matchInfosRepository,
        private EditGlobalInfosMatchOutputBoundary $presenter,
        private MatchMapper $matchMapper,
        private MatchInfosMapper $matchInfosMapper,
    ){}

    public function execute(EditGlobalInfosMatchRequest $request) : EditGlobalInfosMatchResponse
    {
        $matchInfra = $this->matchRepository->findById($request->idMatch);
        $match = $this->matchMapper->toDomain($matchInfra);

        if($request->editGlobalInfosMatchDTO != null)
        {
            $editGlobalInfosMatchInfra = $this->matchInfosRepository->findByMatch($match->getId());
            $editGlobalInfosMatch = $this->matchInfosMapper->toDomain($editGlobalInfosMatchInfra);

            $editGlobalInfosMatch->setPreMatchInfo($request->editGlobalInfosMatchDTO->getPreMatchInfo());
            $editGlobalInfosMatch->setPostMatchInfo($request->editGlobalInfosMatchDTO->getPostMatchInfo());
            $editGlobalInfosMatch->setHomeTeamInfo($request->editGlobalInfosMatchDTO->getHomeTeamInfo());
            $editGlobalInfosMatch->setAwayTeamInfo($request->editGlobalInfosMatchDTO->getAwayTeamInfo());

            $this->matchInfosRepository->save($this->matchInfosMapper->toInfra($editGlobalInfosMatch));
        }

        $response = new EditGlobalInfosMatchResponse(
            $match
        );
        $this->presenter->present($response);

        return $response;
    }
}
