<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Exception\DomainException;
use Domain\Mapper\UserMapper;
use Domain\Request\Login\LoginRequest;
use Domain\Request\Logout\LogoutRequest;
use Domain\Request\RegisterUser\RegisterUserRequest;
use Domain\UseCase\Login\LoginUseCase;
use Domain\UseCase\Logout\LogoutUseCase;
use Domain\UseCase\RegisterUser\RegisterUserUseCase;
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
    public function register(Request $request, RegisterUserUseCase $registerUseCase, UserMapper $userMapper, Security $security): Response
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

                $userInfra = $userMapper->toInfra($registerResponse->user);
                $security->login($userInfra);

                return $this->redirectToRoute('home');
            }catch(DomainException $de){
                $this->addFlash('error', $de->getMessage());
            }
        }

        return $this->redirectToRoute('login_page');
    }

    #[Route('/login', name: 'login')]
    public function login(Request $request, Security $security, LoginUseCase $useCase, UserMapper $userMapper): Response
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

                $userInfra = $userMapper->toInfra($loginResponse->user);
                $security->login($userInfra);

                return $this->redirectToRoute('home');
            }catch(DomainException $d){
                $this->addFlash('error', $d->getMessage());
            }
        }

        return $this->redirectToRoute('login_page');
    }

    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(Request $request, LogoutUseCase $useCase): Response
    {
        $useCase->execute(new LogoutRequest());
        return $this->redirectToRoute('home');
    }
}
