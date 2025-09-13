<?php

namespace Application\Command\CreateTeam;

use Domain\Mapper\TeamMapper;
use Domain\Repository\Team\TeamWriteRepository;
use Domain\Request\CreateTeam\CreateTeamRequest;
use Domain\Response\CreateTeam\CreateTeamResponse;
use Domain\Validator\CreateTeam\CreateTeamValidator;

class CreateTeamCommand
{

    public function __construct(
        private TeamWriteRepository $teamRepository,
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
