<?php

namespace Infrastructure\Symfony\Controller;

use Application\Command\EditGlobalInfosMatch\EditGlobalInfosMatchCommand;
use Application\Command\EditGlobalInfosMatch\EditGlobalInfosMatchOutputBoundary;
use Application\Command\ExportReport\ExportReportCommand;
use Application\Query\FetchMatchs\FetchMatchsQuery;
use Application\Query\ListMatchInfos\ListMatchInfosQuery;
use Application\Query\ShowDetailsMatch\ShowDetailsMatchQuery;
use Domain\Dto\EditGlobalInfosMatch\EditGlobalInfosMatchDTO;
use Domain\Presenter\FetchMatchs\FetchMatchsPresenter;
use Domain\Presenter\ShowDetailsMatch\ShowDetailsMatchPresenter;
use Domain\Request\EditGlobalInfosMatch\EditGlobalInfosMatchRequest;
use Domain\Request\ExportReport\ExportReportRequest;
use Domain\Request\FetchMatchs\FetchMatchsRequest;
use Domain\Request\ListMatchInfos\ListMatchInfosRequest;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Infrastructure\Symfony\Form\EditGlobalInfosMatchTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{
    #[Route('/matchs', name: 'get_matchs')]
    public function fetchMatchs(Request $request, FetchMatchsQuery $useCase, FetchMatchsPresenter $presenter): Response
    {
        $request = new FetchMatchsRequest();
        $useCase->execute($request);

        return $this->render('matchs/index.html.twig', [
            'viewModel' => $presenter->getViewModel()
        ]);
    }

    #[Route('/matchs/details/{idMatch}/{idTeam}', name: 'details_match')]
    public function detailsMatch(Request $request, int $idMatch, int $idTeam, ShowDetailsMatchQuery $useCase, ShowDetailsMatchPresenter $presenter): Response
    {
        $request = new ShowDetailsMatchRequest($idMatch, $idTeam);
        $response = $useCase->execute($request);

        return $this->render('matchs/details.html.twig', [
            'viewModel' => $presenter->getViewModel()
        ]);
    }

    #[Route('/matchs/{idMatch}/global', name: 'details_match_global')]
    public function detailsMatchGlobal(Request $request, int $idMatch, EditGlobalInfosMatchCommand $useCase, EditGlobalInfosMatchOutputBoundary $presenter, ListMatchInfosQuery $listMatchInfosUseCase): Response
    {
        $requestListMatchInfos = new ListMatchInfosRequest($idMatch);
        $responseListMatchInfos = $listMatchInfosUseCase->execute($requestListMatchInfos);
        $editGlobalInfosMatchDTO = EditGlobalInfosMatchDTO::fromMatchInfos($responseListMatchInfos->matchInfos);

        $editGlobalInfosMatchForm = $this->createForm(EditGlobalInfosMatchTypeForm::class, $editGlobalInfosMatchDTO);
        $editGlobalInfosMatchForm->handleRequest($request);

        $editGlobalInfosMatchDTO = null;
        if($editGlobalInfosMatchForm->isSubmitted() && $editGlobalInfosMatchForm->isValid())
        {
            $editGlobalInfosMatchDTO = $editGlobalInfosMatchForm->getData();
            $this->addFlash("notice", "Les informations ont été enregistrés avec succès");
        }

        $request = new EditGlobalInfosMatchRequest($idMatch, $editGlobalInfosMatchDTO);
        $useCase->execute($request);

        return $this->render('matchs/global.html.twig', [
            'viewModel' => $presenter->getViewModel(),
            'form' => $editGlobalInfosMatchForm->createView()
        ]);
    }

    #[Route('/matchs/export/{idMatch}', name: 'export_match')]
    public function exportMatch(Request $request, int $idMatch, ExportReportCommand $useCase): Response
    {
        $request = new ExportReportRequest($idMatch);
        $useCase->execute($request);

        return $this->render('matchs/details.html.twig', []);
    }
}
