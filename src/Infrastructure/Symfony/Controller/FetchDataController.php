<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Request\FetchData\FetchDataRequest;
use Domain\UseCase\FetchData\FetchDataUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FetchDataController extends AbstractController
{
    public function __construct(){}

    #[Route('/fetch-data', name: 'fetch_data')]
    public function fetchData(FetchDataUseCase $useCase): Response
    {
        $request = new FetchDataRequest();
        $useCase->execute($request);

        return new Response();
    }
}
