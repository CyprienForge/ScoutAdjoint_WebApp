<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Request\FetchMatchs\FetchMatchsRequest;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Domain\UseCase\FetchMatchs\FetchMatchsOutputBoundary;
use Domain\UseCase\FetchMatchs\FetchMatchsUseCase;
use Domain\UseCase\ShowDetailsMatch\ShowDetailsMatchOutputBoundary;
use Domain\UseCase\ShowDetailsMatch\ShowDetailsMatchUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{
    #[Route('/matchs', name: 'get_matchs')]
    public function fetchMatchs(Request $request, FetchMatchsUseCase $useCase, FetchMatchsOutputBoundary $presenter): Response
    {
        $request = new FetchMatchsRequest();
        $useCase->execute($request);

        return $this->render('matchs/index.html.twig', [
            'viewModel' => $presenter->getViewModel()
        ]);
    }

    #[Route('/matchs/details/{idMatch}/{idTeam}', name: 'details_match')]
    public function detailsMatch(Request $request, int $idMatch, int $idTeam, ShowDetailsMatchUseCase $useCase, ShowDetailsMatchOutputBoundary $presenter): Response
    {
        $request = new ShowDetailsMatchRequest($idMatch, $idTeam);
        $response = $useCase->execute($request);

        return $this->render('matchs/details.html.twig', [
            'viewModel' => $presenter->getViewModel()
        ]);
    }
}
