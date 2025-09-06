<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Dto\EditUser\EditUserDTO;
use Domain\Exception\DomainException;
use Domain\Mapper\UserMapper;
use Domain\Request\DeleteUser\DeleteUserRequest;
use Domain\Request\EditUser\EditUserRequest;
use Domain\Request\FetchUsers\FetchUsersRequest;
use Domain\Request\ShowDetailsUser\ShowDetailsUserRequest;
use Domain\Response\FetchUsers\FetchUsersResponse;
use Domain\UseCase\DeleteUser\DeleteUserUseCase;
use Domain\UseCase\EditUser\EditUserUseCase;
use Domain\UseCase\ShowDetailsUser\ShowDetailsUserOutputBoundary;
use Domain\UseCase\ShowDetailsUser\ShowDetailsUserUseCase;
use Domain\UseCase\FetchUsers\FetchUsersOutputBoundary;
use Domain\UseCase\FetchUsers\FetchUsersUseCase;
use Infrastructure\Symfony\Form\EditUserTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SettingController extends AbstractController
{

    #[Route('/settings', name: 'settings')]
    public function index(FetchUsersUseCase $useCase, FetchUsersOutputBoundary $presenter): Response
    {
        $fetchUsersRequest = new FetchUsersRequest();
        $fetchUsersResponse = $useCase->execute($fetchUsersRequest);
        $presenter->present($fetchUsersResponse);

        return $this->render('setting/index.html.twig', [
            'viewModel' => $presenter->getViewModel()
        ]);
    }

    #[Route('/delete-user/{idUser}', name: 'delete_user')]
    public function deleteUser(DeleteUserUseCase $useCase, UserMapper $userMapper, int $idUser): Response
    {
        $currentUserInfra = $this->getUser();
        $currentUser = $userMapper->toDomain($currentUserInfra);

        $request = new DeleteUserRequest($currentUser, $idUser);
        try{
            $response = $useCase->execute($request);
        }catch(DomainException $e){
            $this->addFlash('error', $e->getMessage());
        }

        return $this->redirectToRoute('settings');
    }

    #[Route('/edit-user/{idUser}', name: 'edit_user')]
    public function editUser(Request $request, ShowDetailsUserUseCase $useCase, int $idUser, ShowDetailsUserOutputBoundary $presenter, EditUserUseCase $editUserUseCase): Response
    {
        $requestDetailsUser = new ShowDetailsUserRequest($idUser);
        $responseDetailsUser = $useCase->execute($requestDetailsUser);
        $presenter->present($responseDetailsUser);

        $editUserDTO = new EditUserDTO($responseDetailsUser->user->getRoles());
        $editUserForm = $this->createForm(EditUserTypeForm::class, $editUserDTO);
        $editUserForm->handleRequest($request);

        if($editUserForm->isSubmitted() && $editUserForm->isValid())
        {
            $editUserRequest = new EditUserRequest($responseDetailsUser->user, $editUserForm->getData()->roles);
            $editUserUseCase->execute($editUserRequest);

            return $this->redirectToRoute('settings');
        }

        return $this->render('setting/edit_user.html.twig', [
            'viewModel' => $presenter->getViewModel(),
            'form' => $editUserForm->createView(),
        ]);
    }

}
