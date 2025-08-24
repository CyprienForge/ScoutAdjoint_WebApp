<?php

namespace Domain\UseCase\CreateTeam;

use Domain\Mapper\TeamMapper;
use Domain\Repository\TeamRepository;
use Domain\Request\CreateTeam\CreateTeamRequest;
use Domain\Response\CreateTeam\CreateTeamResponse;
use Domain\Validator\CreateTeam\CreateTeamValidator;

class CreateTeamUseCase
{

    public function __construct(
        private TeamRepository $teamRepository,
        private TeamMapper $teamMapper,
        private CreateTeamValidator $createTeamValidator,
    ){}

    public function execute(CreateTeamRequest $request): CreateTeamResponse
    {
        $this->createTeamValidator->validate($request->team);
        $teamInfra = $this->teamMapper->toInfra($request->team);
        $this->teamRepository->save($teamInfra);

        return new CreateTeamResponse();
    }

}
