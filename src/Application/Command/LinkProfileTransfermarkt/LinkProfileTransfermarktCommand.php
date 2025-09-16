<?php

namespace Application\Command\LinkProfileTransfermarkt;

use Domain\Mapper\PlayerMapper;
use Domain\Repository\Player\PlayerReadRepository;
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
    ){}

    public function execute(LinkProfileTransfermarktRequest $request): LinkProfileTransfermarktResponse
    {
        $player = $this->playerRepository->findById($request->idPlayer);

        $linkTransfermarktProfile = $this->searcher->searchLinkProfileTransfermarkt($player);
        $player->setTransfermarktUrl($linkTransfermarktProfile);

        $this->playerWriteRepository->save($player);
        return new LinkProfileTransfermarktResponse();
    }

}
