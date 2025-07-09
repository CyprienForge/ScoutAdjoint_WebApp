<?php

namespace Domain\Factory;

use Domain\Entity\Player;

/**
 * @implements Factory<Player>
 */
class PlayerFactory implements Factory
{
    public static function build($attributes) : Player
    {
        $player = new Player();
        $player->setId($attributes['id']);
        $player->setFirstName($attributes['first_name']);
        $player->setLastName($attributes['last_name']);
        $birth_date = new \DateTime($attributes['birth_date']);
        $player->setBirthDate($birth_date);
        $player->setTeam($attributes['team']);

        return $player;
    }
}
