<?php

namespace Infrastructure\Symfony\Controller\Api;

use Application\Command\ExportReport\ExportReportCommand;
use Application\Query\FetchMatchs\FetchMatchsQuery;
use Application\Query\ListMatchInfos\ListMatchInfosQuery;
use Application\Query\ShowDetailsMatch\ShowDetailsMatchQuery;
use Domain\Exception\NotFoundException;
use Domain\Presenter\FetchMatchs\FetchMatchsPresenter;
use Domain\Presenter\ListMatchInfos\ListMatchInfosPresenter;
use Domain\Presenter\ShowDetailsMatch\ShowDetailsMatchPresenter;
use Domain\Request\ExportReport\ExportReportRequest;
use Domain\Request\FetchMatchs\FetchMatchsRequest;
use Domain\Request\ListMatchInfos\ListMatchInfosRequest;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchApiController extends AbstractController
{
    public function __construct(
        private FetchMatchsPresenter $presenter,
        private ListMatchInfosPresenter $listMatchInfosPresenter
    ){}

    #[Route('/api/matchs', name: 'api_get_matchs')]
    public function fetchMatchs(Request $request, FetchMatchsQuery $useCase): Response
    {
        try{
            $request = new FetchMatchsRequest();
            $response = $useCase->execute($request);
        }catch (\Exception $exception){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], 500);
        }

        return new JsonResponse($this->presenter->getPresentation(), 200);
    }

    #[Route('api/matchs/{idMatch}', name: 'api_details_match')]
    public function detailsMatchGlobal(Request $request, int $idMatch, ListMatchInfosQuery $useCase): Response
    {
        try{
            $request = new ListMatchInfosRequest($idMatch);
            $response = $useCase->execute($request);
            $this->listMatchInfosPresenter->present($response);
        }catch (NotFoundException $e){
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }
        catch (\Exception $exception){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], 500);
        }

        return new JsonResponse($this->listMatchInfosPresenter->getPresentation(), 200);
    }

    #[Route('/api/matchs/export/{idMatch}', name: 'api_export_match')]
    public function exportMatch(Request $request, int $idMatch, ExportReportCommand $useCase): Response
    {
        try{
            $request = new ExportReportRequest($idMatch);
            $response = $useCase->execute($request);
        }catch (\Exception $exception){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], 500);
        }

        return new Response(
            $response->pdfBinary,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$response->fileName.'"',
                'Content-Length' => strlen($response->pdfBinary),
            ]
        );
    }

    #[Route('api/matchs/details/{idMatch}/{idTeam}', name: 'api_details_match_participations', methods: ['GET'])]
    public function detailsMatch(int $idMatch, int $idTeam, ShowDetailsMatchQuery $useCase, ShowDetailsMatchPresenter $presenter): Response
    {
        try{
            $request = new ShowDetailsMatchRequest($idMatch, $idTeam);
            $response = $useCase->execute($request);
        }catch (\Exception $e){
            return new JsonResponse(['message' => 'Une erreur innatendue est survenue !'], 500);
        }
        return new JsonResponse($presenter->getPresentation(), 200);
    }

}
