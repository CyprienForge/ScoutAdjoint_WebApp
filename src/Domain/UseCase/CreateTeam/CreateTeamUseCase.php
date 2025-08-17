<?php

namespace Domain\UseCase\CreateTeam;

use Domain\Mapper\TeamMapper;
use Domain\Repository\TeamRepository;
use Domain\Request\CreateTeam\CreateTeamRequest;
use Domain\Response\CreateTeamResponse;

class CreateTeamUseCase
{

    public function __construct(
        private TeamRepository $teamRepository,
        private TeamMapper $teamMapper
    ){}

    public function execute(CreateTeamRequest $request): CreateTeamResponse
    {
        $teamInfra = $this->teamMapper->toInfra($request->team);
        $this->teamRepository->save($teamInfra);

        return new CreateTeamResponse();
    }

}
