<?php

namespace Application\Command\EditGlobalInfosMatch;

use Domain\Mapper\MatchInfosMapper;
use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchReadRepository;
use Domain\Repository\MatchInfos\MatchInfosReadRepository;
use Domain\Repository\MatchInfos\MatchInfosWriteRepository;
use Domain\Request\EditGlobalInfosMatch\EditGlobalInfosMatchRequest;
use Domain\Response\EditGlobalInfosMatch\EditGlobalInfosMatchResponse;

class EditGlobalInfosMatchCommand
{
    public function __construct(
        private MatchReadRepository $matchRepository,
        private MatchInfosReadRepository $matchInfosRepository,
        private MatchInfosWriteRepository $matchInfosWriteRepository,
        private EditGlobalInfosMatchOutputBoundary $presenter,
    ){}

    public function execute(EditGlobalInfosMatchRequest $request) : EditGlobalInfosMatchResponse
    {
        $match = $this->matchRepository->findById($request->idMatch);

        if($request->editGlobalInfosMatchDTO != null)
        {
            $editGlobalInfosMatch = $this->matchInfosRepository->findByMatch($match->getId());

            $editGlobalInfosMatch->setPreMatchInfo($request->editGlobalInfosMatchDTO->getPreMatchInfo());
            $editGlobalInfosMatch->setPostMatchInfo($request->editGlobalInfosMatchDTO->getPostMatchInfo());
            $editGlobalInfosMatch->setHomeTeamInfo($request->editGlobalInfosMatchDTO->getHomeTeamInfo());
            $editGlobalInfosMatch->setAwayTeamInfo($request->editGlobalInfosMatchDTO->getAwayTeamInfo());

            $this->matchInfosWriteRepository->save($editGlobalInfosMatch);
        }

        $response = new EditGlobalInfosMatchResponse(
            $match
        );
        $this->presenter->present($response);

        return $response;
    }
}
