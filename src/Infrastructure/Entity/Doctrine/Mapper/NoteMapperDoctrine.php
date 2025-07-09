<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Note;
use Domain\Entity\Participation;
use Domain\Mapper\NoteMapper;
use Domain\Mapper\ParticipationMapper;
use Infrastructure\Entity\Doctrine\NoteDoctrine;

class NoteMapperDoctrine implements NoteMapper
{

    public function toDomain($item)
    {
        $participationMapper = new ParticipationMapperDoctrine();
        $noteDomain = new Note();
        $noteDomain->setId($item->getId());
        $noteDomain->setContent($item->getContent());

        $participationDomain = $participationMapper->toDomain($item->getParticipation());
        $noteDomain->setParticipation($participationDomain);
        $noteDomain->setMinute($item->getMinute());

        return $noteDomain;
    }

    public function toInfra($item)
    {
        $participationMapper = new ParticipationMapperDoctrine();

        $noteInfra = new NoteDoctrine();
        $noteInfra->setId($item->getId());
        $noteInfra->setContent($item->getContent());

        $participationDoctrine = $participationMapper->toInfra($item->getParticipation());
        $noteInfra->setParticipation($participationDoctrine);
        $noteInfra->setMinute($item->getMinute());

        return $noteInfra;
    }
}
