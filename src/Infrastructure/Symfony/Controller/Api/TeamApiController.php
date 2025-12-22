<?php

namespace Infrastructure\Symfony\Controller\Api;

use Application\Query\FetchTeams\FetchTeamsQuery;
use Domain\Presenter\FetchTeams\FetchTeamsPresenter;
use Domain\Request\FetchTeams\FetchTeamsRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamApiController extends AbstractController
{

    #[Route('/api/teams', name: 'api_get_teams')]
    public function fetchTeams(FetchTeamsQuery $useCase, FetchTeamsPresenter $presenter) : Response
    {
        try{
            $request = new FetchTeamsRequest();
            $response = $useCase->execute($request);
        }catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue'], 500);
        }

        return new JsonResponse($presenter->getPresentation(), 200);
    }

}
