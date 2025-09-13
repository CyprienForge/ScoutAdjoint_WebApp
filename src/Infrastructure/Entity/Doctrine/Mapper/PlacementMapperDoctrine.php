<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Mapper\PlacementMapper;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Repository\Position\PositionReadRepository;
use Domain\Repository\Position\PositionRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementMapperDoctrine implements PlacementMapper
{

    public function __construct(
        private PlayerReadRepository $playerRepository,
        private PositionReadRepository $positionRepository,
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
