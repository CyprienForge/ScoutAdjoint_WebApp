<?php

namespace Application\Command\DeletePlayer;

use Domain\Repository\Player\PlayerWriteRepository;
use Domain\Request\DeletePlayer\DeletePlayerRequest;
use Domain\Response\DeletePlayer\DeletePlayerResponse;

class DeletePlayerCommand
{
    public function __construct(
        private PlayerWriteRepository $playerWriteRepository,
    ){}

    public function execute(DeletePlayerRequest $request): DeletePlayerResponse
    {
        $this->playerWriteRepository->deleteById($request->idPlayer);
        return new DeletePlayerResponse();
    }

}
