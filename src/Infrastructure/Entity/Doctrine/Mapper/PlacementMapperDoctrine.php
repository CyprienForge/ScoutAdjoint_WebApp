<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Mapper\PlacementMapper;
use Domain\Repository\PlayerRepository;
use Domain\Repository\PositionRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementMapperDoctrine implements PlacementMapper
{

    public function __construct(
        private PlayerRepository $playerRepository,
        private PositionRepository $positionRepository,
    ){}

    public function toDomain($item)
    {
        // TODO: Implement toDomain() method.
    }

    public function toInfra($item)
    {
        $placementDoctrine = new PlacementDoctrine();

        $playerDoctrine = $this->playerRepository->find($item->getPlayer()->getId());
        $positionDoctrine = $this->positionRepository->find($item->getPosition()->getId());

        $placementDoctrine->setPlayer($playerDoctrine);
        $placementDoctrine->setPosition($positionDoctrine);

        return $placementDoctrine;
    }
}
