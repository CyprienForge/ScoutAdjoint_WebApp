<?php

namespace App\Tests\Repository\Players;

use Domain\Entity\Player\Player;
use Infrastructure\Repository\Supabase\PlayerRepositorySupabase;
use PHPUnit\Framework\TestCase;

class PlayerRepositorySupabaseTest extends TestCase
{
    public function testFindAllReturnsArray() : void
    {
        $repository = new PlayerRepositorySupabase();
        $result = $repository->findAll();

        $this->assertIsArray($result);
    }

    public function testFindAllReturnsPlayers() : void
    {
        $repository = new PlayerRepositorySupabase();
        $result = $repository->findAll();

        $this->assertInstanceOf(Player::class, $result[0]);
    }
}
