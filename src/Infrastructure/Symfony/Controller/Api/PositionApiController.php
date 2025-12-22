<?php

namespace Infrastructure\Symfony\Controller\Api;

use Application\Query\FetchPositions\FetchPositionsQuery;
use Application\Query\FetchPositionsByPlayer\FetchPositionsByPlayerUseCase;
use Domain\Presenter\FetchPositions\FetchPositionsPresenter;
use Domain\Presenter\FetchPositionsByPlayer\FetchPositionsByPlayerPresenter;
use Domain\Request\FetchPositions\FetchPositionsRequest;
use Domain\Request\FetchPositionsByPlayer\FetchPositionsByPlayerRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PositionApiController extends AbstractController
{

    #[Route('/api/positions', name: 'api_get_positions')]
    public function fetchPositions(Request $request, FetchPositionsQuery $fetchPositionsUseCase, FetchPositionsPresenter $presenter): Response
    {
        try{
            $request = new FetchPositionsRequest();
            $response = $fetchPositionsUseCase->execute($request);
            $presenter->present($response);
        }catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue'], 500);
        }

        return new JsonResponse($presenter->getPresentation(), 200);
    }

    #[Route('/api/positions/player/{idPlayer}', name: 'api_get_position_by_player', methods: ['GET'])]
    public function fetchPositionsByPlayer(Request $request, int $idPlayer, FetchPositionsByPlayerUseCase $useCase, FetchPositionsByPlayerPresenter $presenter): Response
    {
        try{
            $request = new FetchPositionsByPlayerRequest($idPlayer);
            $response = $useCase->execute($request);
        }catch(\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue'], 500);
        }

        return new JsonResponse($presenter->getPresentation(), 200);
    }
}
