<?php

namespace App\Tests\UseCase\FetchPlayers;

use Application\UseCase\FetchPlayers\FetchPlayersQuery;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Response\FetchPlayers\FetchPlayersResponse;
use PHPUnit\Framework\TestCase;

class FetchPlayersTest extends TestCase
{
    public function testRequestBuildable(): void
    {
        $fetcher = new FetchPlayersRequest();

        $this->assertInstanceOf(FetchPlayersRequest::class, $fetcher);
    }

    public function testUseCaseBuildable() : void
    {
        $useCase = new FetchPlayersQuery();

        $this->assertInstanceOf(FetchPlayersQuery::class, $useCase);
    }

    public function testUseCaseExecutable() : void
    {
        $request = new FetchPlayersRequest();
        $useCase = new FetchPlayersQuery();
        $response = $useCase->execute($request);

        $this->assertInstanceOf(FetchPlayersResponse::class, $response);
    }
}
