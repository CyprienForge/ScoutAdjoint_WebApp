<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Placement;
use Domain\Mapper\PlacementMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Mapper\PositionMapper;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Repository\Position\PositionReadRepository;
use Domain\Repository\Position\PositionRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementMapperDoctrine implements PlacementMapper
{

    public function __construct(
        private PlayerReadRepository $playerRepository,
        private PositionReadRepository $positionRepository,
        private PositionMapper $positionMapper,
        private PlayerMapper $playerMapper,
    ){}

    public function toDomain($item)
    {
        $placement = new Placement();

        $placement->setId($item->getId());
        $placement->setPosition($this->positionMapper->toDomain($item->getPosition()));
        $placement->setPlayer($this->playerMapper->toDomain($item->getPlayer()));

        return $placement;
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
