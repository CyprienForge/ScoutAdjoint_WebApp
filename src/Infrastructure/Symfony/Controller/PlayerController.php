<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Dto\CreatePlayer\CreatePlayerDTO;
use Domain\Dto\EditPlayer\EditPlayerDTO;
use Domain\Mapper\PlayerMapper;
use Domain\Mapper\PositionMapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\PlacementRepository;
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

class PlayerController extends AbstractController
{
    public function __construct(
        private FetchPlayersOutputBoundary $presenter,
        private ShowDetailsPlayerOutputBoundary $presenterShowDetails,
        private TeamMapper $teamMapper,
        private PlayerMapper $playerMapper,
        private TeamRepository $teamRepository,
        private PositionRepository $positionRepository,
        private PositionMapper $positionMapper,
        private PlacementRepository $placementRepository,
    ){}

    #[Route('/players/show/{page}', name: 'get_players', defaults: ['page' => 0])]
    public function fetchPlayers(Request $request, FetchPlayersUseCase $fetchPlayersUseCase, int $page): Response
    {
        $searchPlayerForm = $this->createForm(SearchPlayerTypeForm::class);
        $searchPlayerForm->handleRequest($request);

        $firstName = null;
        $lastName = null;
        $startBirthDate = null;
        $endBirthDate = null;

        if($searchPlayerForm->isSubmitted() && $searchPlayerForm->isValid()){
            $task = $searchPlayerForm->getData();
            $firstName = $task['first_name'];
            $lastName = $task['last_name'];
            $startBirthDate = $task['start_birth_date'];
            $endBirthDate = $task['end_birth_date'];
        }

        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($limit, $page * $limit, $page, $firstName, $lastName, $startBirthDate, $endBirthDate);
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return $this->render('players/index.html.twig', [
            'viewModel' => $this->presenter->getViewModel(),
            'form' => $searchPlayerForm->createView(),
        ]);
    }

    #[Route('/players/details/{idPlayer}', name: 'details_player')]
    public function detailsPlayer(Request $request, ShowDetailsPlayerUseCase $useCase, EditPlayerUseCase $editUseCase, int $idPlayer) : Response
    {
        $detailsRequest = new ShowDetailsPlayerRequest($idPlayer);
        $response = $useCase->execute($detailsRequest);

        $allPositionsInfra = $this->positionRepository->findAll();
        $allPositions = array_map(fn($pos) => $this->positionMapper->toDomain($pos), $allPositionsInfra);

        $placementsInfra = array_filter($this->placementRepository->findByPlayer($response->player->getId()));
        $positions = array_map(fn($placement) => $this->positionMapper->toDomain($placement->getPosition()), $placementsInfra);

        $teamsInfra = array_filter($this->teamRepository->findAll());
        $teams = array_map(fn($team) => $this->teamMapper->toDomain($team), $teamsInfra);

        $editPlayerDto = EditPlayerDTO::fromPlayer($response->player);
        $editPlayerDto->setNewPositions($positions);

        $editPlayerForm = $this->createForm(EditPlayerTypeForm::class, $editPlayerDto, [
            'positions' => $allPositions,
            'teams' => $teams
        ]);
        $editPlayerForm->handleRequest($request);

        if($editPlayerForm->isSubmitted() && $editPlayerForm->isValid()){
            $fileImage = $editPlayerForm->get('newImage')->getData();
            $editPlayer = $editPlayerForm->getData();

            // $newImage = new ImagePlayer($fileImage->getClientOriginalName(), $fileImage->getMimeType(), $fileImage->getSize());
            $editRequest = new EditPlayerRequest($editPlayer);
            $editUseCase->execute($editRequest);
        }

        return $this->render('players/details.html.twig', [
            'viewModel' => $this->presenterShowDetails->getViewModel(),
            'form' => $editPlayerForm->createView(),
        ]);
    }

    #[Route('/players/create', name: 'create_player')]
    public function createPlayer(Request $request, CreatePlayerUseCase $useCase): Response
    {
        $teamsInfra = array_filter($this->teamRepository->findAll());
        $positionsInfra = array_filter($this->positionRepository->findAll());
        $teams = array_map(fn($team) => $this->teamMapper->toDomain($team), $teamsInfra);
        $positions = array_map(fn($position) => $this->positionMapper->toDomain($position), $positionsInfra);

        $createPlayerForm = $this->createForm(CreatePlayerTypeForm::class, new CreatePlayerDTO(), [
            'teams' => $teams,
            'positions' => $positions
        ]);
        $createPlayerForm->handleRequest($request);

        if($createPlayerForm->isSubmitted() && $createPlayerForm->isValid())
        {
            $player = $createPlayerForm->getData();
            $request = new CreatePlayerRequest($player);

            $useCase->execute($request);
        }

        return $this->render('players/create.html.twig', [
            'form' => $createPlayerForm->createView(),
        ]);
    }
}
