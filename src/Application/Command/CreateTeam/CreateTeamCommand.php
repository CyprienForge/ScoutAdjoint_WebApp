<?php

namespace Application\Command\CreateTeam;

use Domain\Exception\DomainException;
use Domain\Mapper\TeamMapper;
use Domain\Repository\Team\TeamWriteRepository;
use Domain\Request\CreateTeam\CreateTeamRequest;
use Domain\Response\CreateTeam\CreateTeamResponse;
use Domain\Validator\CreateTeam\CreateTeamValidator;

class CreateTeamCommand
{

    public function __construct(
        private TeamWriteRepository $teamRepository,
        private CreateTeamValidator $createTeamValidator,
    ){}

    public function execute(CreateTeamRequest $request): CreateTeamResponse
    {
        try{
            $this->createTeamValidator->validate($request->team);
        }catch(DomainException $e){
            throw $e;
        }
        $this->teamRepository->save($request->team);

        return new CreateTeamResponse();
    }

}
