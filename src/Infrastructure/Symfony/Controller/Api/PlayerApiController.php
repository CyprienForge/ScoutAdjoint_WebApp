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
use Domain\Exception\NotFoundException;
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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PlayerApiController extends AbstractController
{
    public function __construct(
        private FetchPlayersPresenter      $presenter,
        private ShowDetailsPlayerPresenter $presenterShowDetails,
    ){}

    #[Route('/api/players/show/{page}', name: 'api_get_players', defaults: ['page' => 0])]
    public function fetchPlayers(Request $request, FetchPlayersQuery $fetchPlayersUseCase, int $page): Response
    {
        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($page, null, null, null, null, null, null, $limit, $page * $limit, false);
        $fetchPlayersUseCase->execute($fetchPlayersRequest);

        return new JsonResponse($this->presenter->getPresentation(), Response::HTTP_OK);
    }

    #[Route('/api/players/filter/{page}', name: 'api_filter_players', defaults: ['page' => 0])]
    public function filterPlayers(Request $request, FetchPlayersQuery $fetchPlayersUseCase, FetchPositionsQuery $fetchPositionsUseCase, int $page): Response
    {
        $data = json_decode($request->getContent(), true);
        $firstNameSearch = $data['firstName'] ?? null;
        $lastNameSearch = $data['lastName'] ?? null;
        $teamSearch = $data['teamName'] ?? null;
        $positions = $data['positions'] ?? null;
        $startBirthDateSearch = $data['minBirthDate'] ?? null;
        $endBirthDateSearch = $data['maxBirthDate'] ?? null;
        $isOr = $data['isOr'] ?? true;

        if($startBirthDateSearch != null){
            $startBirthDateSearch = new \DateTime($startBirthDateSearch);
        }
        if($endBirthDateSearch != null){
            $endBirthDateSearch = new \DateTime($endBirthDateSearch);
        }

        $limit = 10;
        $fetchPlayersRequest = new FetchPlayersRequest($page, $firstNameSearch, $lastNameSearch, $startBirthDateSearch, $endBirthDateSearch, $positions, $teamSearch, $limit, $page * $limit, $isOr);
        $response = $fetchPlayersUseCase->execute($fetchPlayersRequest);

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

    #[Route('/api/players', name: 'api_create_player', methods: ['POST'])]
    public function createPlayer(Request $request, CreatePlayerCommand $useCase) : Response
    {
        try{
            $data = json_decode($request->getContent(), true);

            $createPlayerDto = (new CreatePlayerDTO())
                ->setFirstName($data['firstName'])
                ->setLastName($data['lastName'])
                ->setBirthDate(new \DateTime())
                ->setIdTeam($data['team'])
                ->setPositions($data['positions']);
            $requestCommand = new CreatePlayerRequest($createPlayerDto);
            $response = $useCase->execute($requestCommand);
        }catch (NotFoundException $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
        catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new JsonResponse(['message' => 'Joueur crée avec succès'], 200);
    }

    #[Route('/api/players/{idPlayer}', name: 'api_edit_player', methods: ['PUT'])]
    public function editPlayer(Request $request, int $idPlayer, EditPlayerCommand $useCase) : Response
    {
        try{
            $data = json_decode($request->getContent(), true);
            $editPlayerDto = new EditPlayerDTO();
            $editPlayerDto->idPlayer = $idPlayer;
            $editPlayerDto->newFirstName = $data['firstName'];
            $editPlayerDto->newLastName = $data['lastName'];
            $editPlayerDto->newBirthDate = new \DateTime($data['birthDate']);
            $editPlayerDto->newPositions = $data['positions'];
            $editPlayerDto->newTeam = $data['team'];
            $editPlayerDto->newGeneralInfo = $data['generalInfo'];

            $requestUseCase = new EditPlayerRequest($editPlayerDto);
            $useCase->execute($requestUseCase);
        }catch (NotFoundException $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
        catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['Joueur modifié avec succès'], 200);
    }

    #[Route('/api/players/{idPlayer}', name: 'api_edit_player', methods: ['DELETE'])]
    public function deletePlayer(int $idPlayer, DeletePlayerCommand $useCase) : Response
    {
        try{
            $response = $useCase->execute(new DeletePlayerRequest($idPlayer));
        }catch (NotFoundException $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
        catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(["message" => 'Joueur supprimé avec succès'], Response::HTTP_OK);
    }

}
