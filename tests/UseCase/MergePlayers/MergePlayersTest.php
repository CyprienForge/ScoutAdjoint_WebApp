<?php

namespace App\Tests\UseCase\MergePlayers;

use Application\UseCase\MergePlayers\MergePlayersUseCase;
use Domain\Request\MergePlayers\MergePlayersRequest;
use Domain\Response\MergePlayers\MergePlayersResponse;
use PHPUnit\Framework\TestCase;

class MergePlayersTest extends TestCase
{

    public function testIsExecutable()
    {
        $useCase = new MergePlayersUseCase();
        $requestMergePlayers = new MergePlayersRequest(10);

        $useCase->execute($requestMergePlayers);
    }

    public function testShouldReturnResponse()
    {
        $useCase = new MergePlayersUseCase();
        $requestMergePlayers = new MergePlayersRequest(10);

        $response = $useCase->execute($requestMergePlayers);
        $this->assertInstanceOf(MergePlayersResponse::class, $response);
    }

}
