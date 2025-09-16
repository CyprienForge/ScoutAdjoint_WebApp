<?php

namespace Infrastructure\Symfony\Controller;

use Application\Query\FetchBaseData\FetchBaseDataQuery;
use Application\Command\Login\LoginCommand;
use Application\Command\Logout\LogoutCommand;
use Application\Command\RegisterUser\RegisterUserCommand;
use Domain\Exception\DomainException;
use Domain\Mapper\UserMapper;
use Domain\Request\FetchBaseData\FetchBaseDataRequest;
use Domain\Request\Login\LoginRequest;
use Domain\Request\Logout\LogoutRequest;
use Domain\Request\RegisterUser\RegisterUserRequest;
use Infrastructure\Entity\Doctrine\UserDoctrine;
use Infrastructure\Symfony\Form\LoginTypeForm;
use Infrastructure\Symfony\Form\RegisterTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/', name: 'login_page')]
    public function loginPage(Request $request) : Response
    {
        $registerForm = $this->createForm(RegisterTypeForm::class);
        $loginForm = $this->createForm(LoginTypeForm::class);

        return $this->render('home/login.html.twig', [
            'registerForm' => $registerForm->createView(),
            'loginForm' => $loginForm->createView(),
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request, RegisterUserCommand $registerUseCase, UserMapper $userMapper, Security $security): Response
    {
        $registerForm = $this->createForm(RegisterTypeForm::class);
        $registerForm->handleRequest($request);

        if($registerForm->isSubmitted() && $registerForm->isValid())
        {
            $registerData = $registerForm->getData();

            $registerRequest = new RegisterUserRequest(
                $registerData['identifier'],
                $registerData['email'],
                $registerData['password'],
            );

            try{
                $registerResponse = $registerUseCase->execute($registerRequest);

                $userInfra = $userMapper->toInfra($registerResponse->user, new UserDoctrine());
                $security->login($userInfra);

                return $this->redirectToRoute('home');
            }catch(DomainException $de){
                $this->addFlash('error', $de->getMessage());
            }
        }

        return $this->redirectToRoute('login_page');
    }

    #[Route('/login', name: 'login')]
    public function login(Request $request, Security $security, LoginCommand $useCase, UserMapper $userMapper): Response
    {
        $loginForm = $this->createForm(LoginTypeForm::class);
        $loginForm->handleRequest($request);

        if($loginForm->isSubmitted() && $loginForm->isValid())
        {
            $loginData = $loginForm->getData();

            $loginRequest = new LoginRequest(
                $loginData['identifier_email'],
                $loginData['password'],
            );

            try{
                $loginResponse = $useCase->execute($loginRequest);

                $userInfra = $userMapper->toInfra($loginResponse->user, new UserDoctrine());
                $security->login($userInfra);

                return $this->redirectToRoute('home');
            }catch(DomainException $d){
                $this->addFlash('error', $d->getMessage());
            }
        }

        return $this->redirectToRoute('login_page');
    }

    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(Request $request, LogoutCommand $useCase): Response
    {
        $useCase->execute(new LogoutRequest());
        return $this->redirectToRoute('home');
    }

    #[Route('/fetch-base-data', name: 'fetch_base_data')]
    public function fetchBaseData(Request $request, FetchBaseDataQuery $useCase): Response
    {
        $useCase->execute(new FetchBaseDataRequest());
        return new Response();
    }
}
