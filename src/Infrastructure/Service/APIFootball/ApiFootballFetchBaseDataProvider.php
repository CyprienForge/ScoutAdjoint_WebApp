<?php

namespace Infrastructure\Service\APIFootball;

use Domain\Service\FetchBaseData\FetchBaseDataProvider;
use Symfony\Component\HttpClient\HttpClient;

class ApiFootballFetchBaseDataProvider extends ApiFootballProvider implements FetchBaseDataProvider
{
    public function fetchChampionships() : array
    {
        $response = $this->client->request(
            'GET',
            'https://v3.football.api-sports.io/leagues?code=fr'
        );

        $championships = $response->toArray();
        return $championships['response'];
    }

    public function fetchTeams(): array
    {
        $response = $this->client->request(
            'GET',
            'https://v3.football.api-sports.io/teams?country=France'
        );

        $teams = $response->toArray();
        return $teams['response'];
    }
}
