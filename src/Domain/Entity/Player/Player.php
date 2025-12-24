<?php

namespace Domain\Entity\Player;

use Domain\Entity\Player\ValueObject\GeneralNote;
use Domain\Entity\Player\ValueObject\PlayerBirthDate;
use Domain\Entity\Player\ValueObject\PlayerId;
use Domain\Entity\Player\ValueObject\PlayerName;
use Domain\Entity\Player\ValueObject\TransfermarktUrl;
use Domain\Entity\Team;

class Player
{
    private ?PlayerId $id = null;
    private PlayerName $name;
    private PlayerBirthDate $birthDate;
    private ?Team $team = null;
    private TransfermarktUrl $transfermarktUrl;
    private GeneralNote $generalNote;

    public function __construct(
        ?PlayerId $id,
        PlayerName $name,
        PlayerBirthDate $birthDate,
        ?Team $team,
        TransfermarktUrl $transfermarktUrl,
        GeneralNote $generalNote = new GeneralNote()
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->team = $team;
        $this->birthDate = $birthDate;
        $this->transfermarktUrl = $transfermarktUrl;
        $this->generalNote = $generalNote;
    }

    public function getId(): ?PlayerId
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }
    public function changeTeam(Team $team): Player
    {
        $this->team = $team;
        return $this;
    }

    public function modifyNote(string $note) : Player
    {
        $this->generalNote = $this->generalNote->withNote($note);
        return $this;
    }

    public function modifyTransfermarktUrl(string $url) : Player
    {
        $this->transfermarktUrl = $this->transfermarktUrl->withUrl($url);
        return $this;
    }

    public function getName() : PlayerName
    {
        return $this->name;
    }

    public function getBirthDate() : PlayerBirthDate
    {
        return $this->birthDate;
    }

    public function getTransfermarktUrl() : TransfermarktUrl
    {
        return $this->transfermarktUrl;
    }

    public function getGeneralNote() : GeneralNote
    {
        return $this->generalNote;
    }
}
