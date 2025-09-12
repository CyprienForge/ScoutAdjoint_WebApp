<?php

namespace Infrastructure\Symfony\Controller;

use Application\Command\CreatePlayer\CreatePlayerCommand;
use Application\Command\EditPlayer\EditPlayerCommand;
use Application\Query\FetchPlayers\FetchPlayersOutputBoundary;
use Application\Query\FetchPlayers\FetchPlayersQuery;
use Application\Query\FetchPositions\FetchPositionsQuery;
use Application\Command\LinkProfileTransfermarkt\LinkProfileTransfermarktCommand;
use Application\Query\ListEditPlayerInfos\ListEditPlayerInfosQuery;
use Application\Query\ShowDetailsPlayer\ShowDetailsPlayerOutputBoundary;
use Application\Query\ShowDetailsPlayer\ShowDetailsPlayerQuery;
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
use Domain\Request\FetchPositions\FetchPositionsRequest;
use Domain\Request\LinkProfileTransfermarkt\LinkProfileTransfermarktRequest;
use Domain\Request\ListEditPlayerInfos\ListEditPlayerInfosRequest;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
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
    public function fetchPlayers(Request $request, FetchPlayersQuery $fetchPlayersUseCase, FetchPositionsQuery $fetchPositionsUseCase, int $page): Response
    {
        $fetchPositionsResponse = $fetchPositionsUseCase->execute(new FetchPositionsRequest());
        $searchPlayerForm = $this->createForm(SearchPlayerTypeForm::class, null, [
            'positions' => $fetchPositionsResponse->positions,
        ]);
        $searchPlayerForm->handleRequest($request);

        $firstName = null;
        $lastName = null;
        $startBirthDate = null;
        $endBirthDate = null;
        $positions = null;
        $team = null;

        if($searchPlayerForm->isSubmitted() && $searchPlayerForm->isValid()){
            $task = $searchPlayerForm->getData();
            $firstName = $task['first_name'];
            $lastName = $task['last_name'];
            $startBirthDate = $task['start_birth_date'];
            $endBirthDate = $task['end_birth_date'];
            $positions = $task['positions'];
            $team = $task['team'];
        }

        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($page, $firstName, $lastName, $startBirthDate, $endBirthDate, $positions, $team, $limit, $page * $limit);
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return $this->render('players/index.html.twig', [
            'viewModel' => $this->presenter->getViewModel(),
            'form' => $searchPlayerForm->createView(),
        ]);
    }

    #[Route('/players/details/{idPlayer}', name: 'details_player')]
    public function detailsPlayer(Request $request, ShowDetailsPlayerQuery $useCase, EditPlayerCommand $editUseCase,ListEditPlayerInfosQuery $listInfosUseCase, int $idPlayer) : Response
    {
        $detailsRequest = new ShowDetailsPlayerRequest($idPlayer);
        $response = $useCase->execute($detailsRequest);

        $listInfosRequest = new ListEditPlayerInfosRequest($idPlayer);
        $listInfosResponse = $listInfosUseCase->execute($listInfosRequest);

        $editPlayerDto = EditPlayerDTO::fromPlayer($response->player);
        $editPlayerDto->setNewPositions($listInfosResponse->positionsSelected);

        $editPlayerForm = $this->createForm(EditPlayerTypeForm::class, $editPlayerDto, [
            'positions' => $listInfosResponse->allPositions,
            'teams' => $listInfosResponse->teams,
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
    public function createPlayer(Request $request, CreatePlayerCommand $useCase): Response
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

    #[Route('/players/link-transfermarkt/{idPlayer}', name: 'link_transfermarkt_profile')]
    public function linkTransfermarktProfile(Request $request, int $idPlayer, LinkProfileTransfermarktCommand $useCase) : Response
    {
        $request = new LinkProfileTransfermarktRequest($idPlayer);
        $useCase->execute($request);

        return $this->redirectToRoute('details_player', ['idPlayer' => $idPlayer]);
    }

    #[Route('/players/merge-players/{idPlayer}', name: 'merge_players')]
    public function mergePlayers(Request $request, int $idPlayer) : Response
    {
        return $this->render('players/merge.html.twig', []);
    }
}
