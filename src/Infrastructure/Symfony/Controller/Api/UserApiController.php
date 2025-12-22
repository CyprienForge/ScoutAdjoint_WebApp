<?php

namespace Infrastructure\Symfony\Controller\Api;

use Application\Command\EditUser\EditUserCommand;
use Application\Query\FetchUsers\FetchUsersQuery;
use Domain\Presenter\FetchUsers\FetchUsersPresenter;
use Domain\Repository\User\UserReadRepository;
use Domain\Request\EditUser\EditUserRequest;
use Domain\Request\FetchUsers\FetchUsersRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserApiController extends AbstractController
{

    #[Route('/api/users', name: 'api_get_users')]
    public function getUsers(FetchUsersQuery $useCase, FetchUsersPresenter $presenter) : Response
    {
        try{
            $request = new FetchUsersRequest();
            $response = $useCase->execute($request);
        }catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse($presenter->getPresentation(), Response::HTTP_OK);
    }

    #[Route('/api/users/{idUser}', name: 'api_edit_user', methods: ['PUT'])]
    public function editUser(Request $httpRequest, int $idUser, EditUserCommand $useCase, UserReadRepository $repo) : Response
    {
        try{
            $data = json_decode($httpRequest->getContent(), true);
            $user = $repo->findById($idUser);

            $request = new EditUserRequest($user, $data['roles'], 0);
            $response = $useCase->execute($request);
        }catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'User modifié avec succès !'], Response::HTTP_OK);
    }

}
