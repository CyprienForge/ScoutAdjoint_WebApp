<?php

namespace App\Tests\Factory;

use Domain\Entity\Player;
use Domain\Factory\PlayerFactory;
use PHPUnit\Framework\TestCase;

class PlayerFactoryTest extends TestCase
{
    public function testBuildable() : void
    {
        $factory = new PlayerFactory();

        $this->assertInstanceOf(PlayerFactory::class, $factory);
    }

    public function testBuildPlayer() : void
    {
        $factory = new PlayerFactory();
        $player = $factory->build([]);

        $this->assertInstanceOf(Player::class, $player);
    }
}
