<?php

namespace App\Tests\FetchPlayers;

use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Response\FetchPlayers\FetchPlayersResponse;
use Domain\UseCase\FetchPlayers\FetchPlayersUseCase;
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
        $useCase = new FetchPlayersUseCase();

        $this->assertInstanceOf(FetchPlayersUseCase::class, $useCase);
    }

    public function testUseCaseExecutable() : void
    {
        $request = new FetchPlayersRequest();
        $useCase = new FetchPlayersUseCase();
        $response = $useCase->execute($request);

        $this->assertInstanceOf(FetchPlayersResponse::class, $response);
    }
}
