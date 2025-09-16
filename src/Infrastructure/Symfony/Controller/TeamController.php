<?php

namespace Infrastructure\Symfony\Controller;

use Application\Command\CreateTeam\CreateTeamCommand;
use Application\Command\FillSquadTransfermarkt\FillSquadTransfermarktCommand;
use Application\Query\FetchTeams\FetchTeamsOutputBoundary;
use Application\Query\FetchTeams\FetchTeamsQuery;
use Application\Query\ListChampionships\ListChampionshipsQuery;
use Domain\Entity\Team;
use Domain\Exception\DomainException;
use Domain\Repository\Championship\ChampionshipRepository;
use Domain\Request\CreateTeam\CreateTeamRequest;
use Domain\Request\FetchTeams\FetchTeamsRequest;
use Domain\Request\FillSquadTransfermarkt\FillSquadTransfermarktRequest;
use Domain\Request\ListChampionships\ListChampionshipsRequest;
use Infrastructure\Symfony\Form\CreateTeamTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{

    #[Route('/teams/show', name: 'get_teams')]
    public function fetchTeams(Request $request, FetchTeamsQuery $useCase, FetchTeamsOutputBoundary $presenter): Response
    {
        $request = new FetchTeamsRequest();
        $response = $useCase->execute($request);

        return $this->render('teams/index.html.twig', [
            'viewModel' => $presenter->getViewModel()
        ]);
    }

    #[Route('/teams/create', name: 'create_team')]
    public function createTeam(Request $request, CreateTeamCommand $useCase, ListChampionshipsQuery $listChampionshipsUseCase): Response
    {
        $listChampionshipsRequest = new ListChampionshipsRequest();
        $response = $listChampionshipsUseCase->execute($listChampionshipsRequest);

        $createTeamForm = $this->createForm(CreateTeamTypeForm::class, new Team(), [
            'championships' => $response->championships,
        ]);
        $createTeamForm->handleRequest($request);

        if($createTeamForm->isSubmitted() && $createTeamForm->isValid()){
            try{
                $request = new CreateTeamRequest($createTeamForm->getData());
                $useCase->execute($request);
            }catch(DomainException $e){
                $this->addFlash('error', $e->getMessage());
                return $this->redirectToRoute('create_team');
            }

            $this->addFlash('success', "L'équipe a été créée avec succès !");
            return $this->redirectToRoute('get_teams');
        }

        return $this->render('teams/create.html.twig', [
            'form' => $createTeamForm->createView(),
        ]);
    }

    #[Route('/teams/fill', name: 'fill_squad_transfermarkt')]
    public function fillSquadTransfermarkt(Request $request, FillSquadTransfermarktCommand $useCase) : Response
    {
        $request = new FillSquadTransfermarktRequest();
        $useCase->execute($request);

        return new Response();
    }
}
