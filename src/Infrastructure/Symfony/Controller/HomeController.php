<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\UseCase\FetchPlayers\FetchPlayersOutputBoundary;
use Domain\UseCase\FetchPlayers\FetchPlayersUseCase;
use Infrastructure\Symfony\Form\SearchPlayerTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/players/{page}', name: 'get_players', defaults: ['page' => 0])]
    public function fetchPlayers(Request $request, FetchPlayersUseCase $fetchPlayersUseCase, int $page): Response
    {
        $searchPlayerForm = $this->createForm(SearchPlayerTypeForm::class);
        $searchPlayerForm->handleRequest($request);

        $firstName = null;
        $lastName = null;

        if($searchPlayerForm->isSubmitted() && $searchPlayerForm->isValid()){
            $task = $searchPlayerForm->getData();
            $firstName = $task['first_name'];
            $lastName = $task['last_name'];
        }

        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($limit, $page * $limit, $page, $firstName, $lastName);
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return $this->render('players/index.html.twig', [
            'players' => $this->presenter->getViewModel(),
            'pageNumber' => $this->presenter->getPageNumber(),
            'previousPageNumber' => $this->presenter->getPagePreviousNumber(),
            'nextPageNumber' => $this->presenter->getPageNextNumber(),
            'form' => $searchPlayerForm->createView(),
        ]);
    }
}
