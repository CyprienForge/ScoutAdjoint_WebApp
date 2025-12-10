<?php

namespace Infrastructure\Symfony\Controller;

use Application\Command\Login\LoginCommand;
use Application\Command\RegisterUser\RegisterUserCommand;
use Domain\Exception\DomainException;
use Domain\Mapper\UserMapper;
use Domain\Request\Login\LoginRequest;
use Domain\Request\RegisterUser\RegisterUserRequest;
use Infrastructure\Entity\Doctrine\UserDoctrine;
use Infrastructure\Symfony\Form\RegisterTypeForm;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthController extends AbstractController
{

    public function __construct(
        private JWTTokenManagerInterface $jwtManager,
    ){}

    #[Route('/api/register', name: 'api_register')]
    public function registerApi(Request $request, RegisterUserCommand $registerUserCommand, UserMapper $userMapper) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $username = $data['username'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $repeatPassword = $data['repeat_password'] ?? null;

        $registerRequest = new RegisterUserRequest($username, $email, $password);
        try{
            $response = $registerUserCommand->execute($registerRequest);
        }catch(\Exception $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        $jwt = $this->jwtManager->create($userMapper->toInfra($response->user));
        $cookie = new Cookie(
            'BEARER',
            $jwt,
            0,
            '/',
            null,
            $request->isSecure(),
            true,
            false,
            'lax'
        );

        $response = new JsonResponse(['message' => 'Inscription réussie'], Response::HTTP_OK);
        $response->headers->setCookie($cookie);
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200');

        return $response;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request, LoginCommand $loginCommand, UserMapper $userMapper) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $identifier = $data['identifier'] ?? null;
        $password = $data['password'] ?? null;

        if(!$password || !$identifier){
            return new JsonResponse(['message' => 'Informations manquantes !'], Response::HTTP_BAD_REQUEST);
        }

        try{
            $loginRequest = new LoginRequest($identifier, $password);
            $response = $loginCommand->execute($loginRequest);

            $jwt = $this->jwtManager->create($userMapper->toInfra($response->user));
            $cookie = new Cookie(
                'BEARER',
                $jwt,
                0,
                '/',
                null,
                $request->isSecure(),
                true,
                false,
                'lax'
            );

            $response = new JsonResponse(['message' => 'Connexion réussie'], Response::HTTP_OK);
            $response->headers->setCookie($cookie);
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200');

            return $response;
        }catch(\Exception $e){
             return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): JsonResponse {
        $response = new JsonResponse(['message' => 'Logged out'], 200);
        $response->headers->setCookie(
            Cookie::create('BEARER')
                ->withValue('')
                ->withExpires(time() - 3600)
                ->withPath('/')
                ->withSecure(false)
                ->withHttpOnly(true)
                ->withSameSite('lax')
        );
        return $response;
    }


    #[Route('/api/is-connected', name: 'api_is_connected', methods: ['GET'])]
    public function isConnectedApi(Request $request, JWTEncoderInterface $jwtEncoder, UserProviderInterface $userProvider) : JsonResponse
    {
        try{
            $token = $request->cookies->get('BEARER');
            if(!$token) return new JsonResponse(['isAuthenticated' => false], Response::HTTP_OK);
            $payload = $jwtEncoder->decode($token);
            $username = $payload['username'] ?? null;

            $user = $userProvider->loadUserByIdentifier($username);
            if(!$user){
                return new JsonResponse(['isAuthenticated' => false], Response::HTTP_OK);
            }
            $isAdmin = array_search('ROLE_ADMIN', $user->getRoles());
        }catch(\Exception $e){
            return new JsonResponse(['message' => 'Une erreur inattendue est survenue'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse([
            'isAuthenticated' => true,
            'username' => $user->getIdentifier(),
            'email' => $user->getEmail(),
            'isAdmin' => $isAdmin,
        ], 200);
    }

    #[Route('/register', name: 'app_register')]
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
}
