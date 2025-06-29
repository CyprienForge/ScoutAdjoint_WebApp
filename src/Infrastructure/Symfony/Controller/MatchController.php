<?php

namespace Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{

    #[Route('/matchs', name: 'get_matchs')]
    public function fetchMatchs(): Response
    {
        return new Response();
    }

}
