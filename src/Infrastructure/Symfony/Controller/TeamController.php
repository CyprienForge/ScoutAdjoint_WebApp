<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Entity\Team;
use Domain\Mapper\ChampionshipMapper;
use Domain\Repository\ChampionshipRepository;
use Domain\Request\CreateTeam\CreateTeamRequest;
use Domain\UseCase\CreateTeam\CreateTeamUseCase;
use Infrastructure\Symfony\Form\CreateTeamTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{

    public function __construct(
        private ChampionshipRepository $championshipRepository,
        private ChampionshipMapper $championshipMapper,
    ){}

    #[Route('/teams/show', name: 'get_teams')]
    public function fetchTeams(Request $request): Response
    {
        return $this->render('teams/index.html.twig');
    }

    #[Route('/teams/create', name: 'create_team')]
    public function createTeam(Request $request, CreateTeamUseCase $useCase): Response
    {
        $championshipsInfra = $this->championshipRepository->findAll();
        $championships = array_map(fn($championship) => $this->championshipMapper->toDomain($championship), $championshipsInfra);

        $createTeamForm = $this->createForm(CreateTeamTypeForm::class, new Team(), [
            'championships' => $championships,
        ]);
        $createTeamForm->handleRequest($request);

        if($createTeamForm->isSubmitted() && $createTeamForm->isValid()){
            $request = new CreateTeamRequest($createTeamForm->getData());

            $useCase->execute($request);
        }

        return $this->render('teams/create.html.twig', [
            'form' => $createTeamForm->createView(),
        ]);
    }
}
