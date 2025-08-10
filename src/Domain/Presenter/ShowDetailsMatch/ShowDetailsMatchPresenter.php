<?php

namespace Domain\Presenter\ShowDetailsMatch;

use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;
use Domain\UseCase\ShowDetailsMatch\ShowDetailsMatchOutputBoundary;
use Domain\ViewModel\Entity\NoteViewModel;
use Domain\ViewModel\ShowDetailsMatch\ContentNoteViewModel;
use Domain\ViewModel\ShowDetailsMatch\ShowDetailsMatchViewModel;

class ShowDetailsMatchPresenter implements ShowDetailsMatchOutputBoundary
{
    private ShowDetailsMatchViewModel $showDetailsMatchView;

    public function present(ShowDetailsMatchResponse $response)
    {
        $this->showDetailsMatchView = new ShowDetailsMatchViewModel();
        $this->showDetailsMatchView->idMatch = $response->participationsNotes[0]->getParticipation()->getMatch()->getId();
        $this->showDetailsMatchView->homeTeamId = $response->participationsNotes[0]->getParticipation()->getMatch()->getHomeTeam()->getId();
        $this->showDetailsMatchView->awayTeamId = $response->participationsNotes[0]->getParticipation()->getMatch()->getAwayTeam()->getId();
        $this->showDetailsMatchView->homeTeamName = $response->participationsNotes[0]->getParticipation()->getMatch()->getHomeTeam()->getName();
        $this->showDetailsMatchView->awayTeamName = $response->participationsNotes[0]->getParticipation()->getMatch()->getAwayTeam()->getName();

        $idHomeTeam = $response->participationsNotes[0]->getParticipation()->getMatch()->getHomeTeam()->getId();

        $this->showDetailsMatchView->awayTeamSelected = $idHomeTeam == $response->selectedTeamId ? '' : 'btn-info';
        $this->showDetailsMatchView->homeTeamSelected = $idHomeTeam == $response->selectedTeamId ? 'btn-info' : '';

        foreach($response->participationsNotes as $participation){
            $contentViewModels = [];

            foreach($participation->getNotes() as $note){
                $contentViewModels[] = new ContentNoteViewModel(
                    $note->getMinute(),
                    $note->getContent(),
                );
            }

            $this->showDetailsMatchView->notesViewModels[] = new NoteViewModel(
                $participation->getParticipation()->getPlayer()->getId(),
                $participation->getParticipation()->getPlayer()->getFirstName(),
                $participation->getParticipation()->getPlayer()->getLastName(),
                $participation->getParticipation()->getNumero(),
                $contentViewModels,
                $participation->getParticipation()->getPlayer()->getBirthDate()->format('Y')
            );
        }
    }

    public function getViewModel()
    {
        return $this->showDetailsMatchView;
    }
}
