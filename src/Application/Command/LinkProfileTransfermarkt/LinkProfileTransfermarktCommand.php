<?php

namespace Application\Command\LinkProfileTransfermarkt;

use Domain\Mapper\PlayerMapper;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Repository\Player\PlayerRepository;
use Domain\Repository\Player\PlayerWriteRepository;
use Domain\Request\LinkProfileTransfermarkt\LinkProfileTransfermarktRequest;
use Domain\Response\LinkProfileTransfermarkt\LinkProfileTransfermarktResponse;
use Domain\Service\LinkProfileTransfermarkt\LinkProfileTransfermarktSearcher;

class LinkProfileTransfermarktCommand
{
    public function __construct(
        private LinkProfileTransfermarktSearcher $searcher,
        private PlayerReadRepository $playerRepository,
        private PlayerWriteRepository $playerWriteRepository,
        private PlayerMapper $playerMapper,
    ){}

    public function execute(LinkProfileTransfermarktRequest $request): LinkProfileTransfermarktResponse
    {
        $playerInfra = $this->playerRepository->findById($request->idPlayer);
        $player = $this->playerMapper->toDomain($playerInfra);

        $linkTransfermarktProfile = $this->searcher->searchLinkProfileTransfermarkt($player);
        $player->setTransfermarktUrl($linkTransfermarktProfile);

        $playerInfra = $this->playerMapper->toInfra($player);
        $this->playerWriteRepository->save($playerInfra);

        return new LinkProfileTransfermarktResponse();
    }

}
