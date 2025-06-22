<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\UseCase\FetchPlayers\FetchPlayersOutputBoundary;
use Domain\UseCase\FetchPlayers\FetchPlayersUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private FetchPlayersOutputBoundary $presenter
    ){}

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/players', name: 'get_players')]
    public function fetchPlayers(FetchPlayersUseCase $fetchPlayersUseCase): Response
    {
        $fetchPlayersRequest = new FetchPlayersRequest();
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return $this->render('players/index.html.twig', [
            'players' => $this->presenter->getViewModel()
        ]);
    }
}
