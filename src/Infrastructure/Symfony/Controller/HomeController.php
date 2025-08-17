<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Dto\CreatePlayer\CreatePlayerDTO;
use Domain\Entity\Player;
use Domain\Mapper\PlayerMapper;
use Domain\Mapper\PositionMapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\PositionRepository;
use Domain\Repository\TeamRepository;
use Domain\Request\CreatePlayer\CreatePlayerRequest;
use Domain\Request\EditPlayer\EditPlayerRequest;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\UseCase\CreatePlayer\CreatePlayerUseCase;
use Domain\UseCase\EditPlayer\EditPlayerUseCase;
use Domain\UseCase\FetchPlayers\FetchPlayersOutputBoundary;
use Domain\UseCase\FetchPlayers\FetchPlayersUseCase;
use Domain\UseCase\ShowDetailsPlayer\ShowDetailsPlayerOutputBoundary;
use Domain\UseCase\ShowDetailsPlayer\ShowDetailsPlayerUseCase;
use Infrastructure\Symfony\Form\CreatePlayerTypeForm;
use Infrastructure\Symfony\Form\EditPlayerTypeForm;
use Infrastructure\Symfony\Form\SearchPlayerTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
