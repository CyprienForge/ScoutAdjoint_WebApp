<?php

namespace Infrastructure\Symfony\Controller\Api;

use Application\Command\CreatePlayer\CreatePlayerCommand;
use Application\Command\DeletePlayer\DeletePlayerCommand;
use Application\Command\EditPlayer\EditPlayerCommand;
use Application\Command\LinkProfileTransfermarkt\LinkProfileTransfermarktCommand;
use Application\Query\FetchPlayers\FetchPlayersQuery;
use Application\Query\FetchPositions\FetchPositionsQuery;
use Application\Query\FetchTeams\FetchTeamsQuery;
use Application\Query\ListEditPlayerInfos\ListEditPlayerInfosQuery;
use Application\Query\ShowDetailsPlayer\ShowDetailsPlayerQuery;
use Application\Query\ShowMergeInfos\ShowMergeOutputBoundary;
use Application\Query\ShowMergeInfos\ShowMergeQuery;
use Domain\Dto\CreatePlayer\CreatePlayerDTO;
use Domain\Dto\EditPlayer\EditPlayerDTO;
use Domain\Exception\ShowDetailsPlayer\PlayerNotFoundException;
use Domain\Presenter\FetchPlayers\FetchPlayersPresenter;
use Domain\Presenter\ShowDetailsPlayer\ShowDetailsPlayerPresenter;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Request\CreatePlayer\CreatePlayerRequest;
use Domain\Request\DeletePlayer\DeletePlayerRequest;
use Domain\Request\EditPlayer\EditPlayerRequest;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Request\FetchPositions\FetchPositionsRequest;
use Domain\Request\FetchTeams\FetchTeamsRequest;
use Domain\Request\LinkProfileTransfermarkt\LinkProfileTransfermarktRequest;
use Domain\Request\ListEditPlayerInfos\ListEditPlayerInfosRequest;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\Request\ShowMerge\ShowMergeRequest;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;
use Infrastructure\Symfony\Form\CreatePlayerTypeForm;
use Infrastructure\Symfony\Form\EditPlayerTypeForm;
use Infrastructure\Symfony\Form\MergePlayer\MergePlayerTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerApiController extends AbstractController
{
    public function __construct(
        private FetchPlayersPresenter      $presenter,
        private ShowDetailsPlayerPresenter $presenterShowDetails,
    ){}

    #[Route('/api/players/show/{page}', name: 'api_get_players', defaults: ['page' => 0])]
    public function fetchPlayers(Request $request, FetchPlayersQuery $fetchPlayersUseCase, FetchPositionsQuery $fetchPositionsUseCase, int $page): Response
    {
        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($page, null, null, null, null, null, null, $limit, $page * $limit);
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return new JsonResponse($this->presenter->getPresentation(), Response::HTTP_OK);
    }

    #[Route('/api/players/filter/{page}', name: 'api_filter_players', defaults: ['page' => 0])]
    public function filterPlayers(Request $request, FetchPlayersQuery $fetchPlayersUseCase, FetchPositionsQuery $fetchPositionsUseCase, int $page): Response
    {
        $firstNameSearch = $request->query->get('firstName') ?? null;
        $lastNameSearch = $request->query->get('lastName') ?? null;
        $teamSearch = $request->query->get('team') ?? null;

        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($page, $firstNameSearch, $lastNameSearch, null, null, null, $teamSearch, $limit, $page * $limit);
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return new JsonResponse($this->presenter->getPresentation(), Response::HTTP_OK);
    }

    #[Route('/api/players/details/{idPlayer}', name: 'api_details_player')]
    public function detailsPlayer(Request $request, ShowDetailsPlayerQuery $useCase, int $idPlayer) : Response
    {
        try{
            $useCaseRequest = new ShowDetailsPlayerRequest($idPlayer);
            $useCaseResponse = $useCase->execute($useCaseRequest);
        }catch (PlayerNotFoundException $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch(\Exception $e){
            return new JsonResponse(['message' => 'Une erreur inattendue est survenue'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse($this->presenterShowDetails->getPresentation(), Response::HTTP_OK);
    }

    #[Route('/players/create', name: 'create_player')]
    public function createPlayer(Request $request, CreatePlayerCommand $useCase, FetchTeamsQuery $queryFetchTeams, FetchPositionsQuery $fetchPositionsQuery): Response
    {
        $response = $queryFetchTeams->execute(new FetchTeamsRequest());
        $teams = $response->teams;

        $response = $fetchPositionsQuery->execute(new FetchPositionsRequest());
        $positions = $response->positions;

        $createPlayerForm = $this->createForm(CreatePlayerTypeForm::class, new CreatePlayerDTO(), [
            'teams' => $teams,
            'positions' => $positions
        ]);
        $createPlayerForm->handleRequest($request);

        if($createPlayerForm->isSubmitted() && $createPlayerForm->isValid())
        {
            $player = $createPlayerForm->getData();
            $request = new CreatePlayerRequest($player);

            $response = $useCase->execute($request);
            return $this->redirectToRoute('details_player', ['idPlayer' => $response->playerCreated->getId()]);
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

    #[Route('/players/merge-players/{idPlayer}', name: 'merge_players_page')]
    public function mergePlayers(Request $request, ShowMergeQuery $useCase, int $idPlayer, ShowMergeOutputBoundary $showMergeOutputBoundary) : Response
    {
        $useCase->execute(new ShowMergeRequest($idPlayer));

        $form = $this->createForm(MergePlayerTypeForm::class);
        $form->handleRequest($request);

        return $this->render('players/merge.html.twig', [
            'viewModel' => $showMergeOutputBoundary->getViewModel(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/players/delete/{idPlayer}', name: 'delete_player')]
    public function deletePlayer(Request $request, int $idPlayer, DeletePlayerCommand $useCase) : Response
    {
        $useCase->execute(new DeletePlayerRequest($idPlayer));
        return $this->redirectToRoute('get_players', ['page' => 0]);
    }

    #[Route('/test', name: 'list_players')]
    public function listPlayers(PlayerReadRepository $playerReadRepository): JsonResponse
    {
        $players = $playerReadRepository->findAll();

        $results = array_map(fn(PlayerDoctrine $player) => [
            'id' => $player->getId(),
            'name' => $player->getName(),
        ], $players);

        ($results);
        return new JsonResponse($results);
    }

}
