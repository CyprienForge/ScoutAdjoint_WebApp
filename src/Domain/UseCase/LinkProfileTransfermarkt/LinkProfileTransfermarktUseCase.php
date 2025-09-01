<?php

namespace Domain\UseCase\LinkProfileTransfermarkt;

use Domain\Mapper\PlayerMapper;
use Domain\Repository\PlayerRepository;
use Domain\Request\LinkProfileTransfermarkt\LinkProfileTransfermarktRequest;
use Domain\Response\LinkProfileTransfermarkt\LinkProfileTransfermarktResponse;
use Domain\Service\LinkProfileTransfermarkt\LinkProfileTransfermarktSearcher;

class LinkProfileTransfermarktUseCase
{
    public function __construct(
        private LinkProfileTransfermarktSearcher $searcher,
        private PlayerRepository $playerRepository,
        private PlayerMapper $playerMapper,
    ){}

    public function execute(LinkProfileTransfermarktRequest $request): LinkProfileTransfermarktResponse
    {
        $playerInfra = $this->playerRepository->findById($request->idPlayer);
        $player = $this->playerMapper->toDomain($playerInfra);

        $linkTransfermarktProfile = $this->searcher->searchLinkProfileTransfermarkt($player);
        $player->setTransfermarktUrl($linkTransfermarktProfile);

        $playerInfra = $this->playerMapper->toInfra($player);
        $this->playerRepository->save($playerInfra);

        return new LinkProfileTransfermarktResponse();
    }

}
