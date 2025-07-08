<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Request\FetchMatchs\FetchMatchsRequest;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Domain\UseCase\FetchMatchs\FetchMatchsOutputBoundary;
use Domain\UseCase\FetchMatchs\FetchMatchsUseCase;
use Domain\UseCase\ShowDetailsMatch\ShowDetailsMatchUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{
    public function __construct(
        private FetchMatchsOutputBoundary $presenter
    ){}
    #[Route('/matchs', name: 'get_matchs')]
    public function fetchMatchs(Request $request, FetchMatchsUseCase $useCase): Response
    {
        $request = new FetchMatchsRequest();
        $useCase->execute($request);

        return $this->render('matchs/index.html.twig', [
            'viewModel' => $this->presenter->getViewModel()
        ]);
    }

    #[Route('/matchs/details/{idMatch}', name: 'details_match')]
    public function detailsMatch(Request $request, int $idMatch, ShowDetailsMatchUseCase $useCase): Response
    {
        $request = new ShowDetailsMatchRequest($idMatch);
        $response = $useCase->execute($request);

        return new Response();
    }
}
