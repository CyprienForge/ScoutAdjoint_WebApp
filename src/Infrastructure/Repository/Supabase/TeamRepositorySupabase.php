<?php

namespace Infrastructure\Repository\Supabase;

use Domain\Factory\TeamFactory;
use Domain\Repository\ChampionshipRepository;
use Domain\Repository\TeamRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TeamRepositorySupabase implements TeamRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private ChampionshipRepository $championshipRepository,
        private string $apiUrl,
        private string $apiKey
    ){}
    public function save($item): void
    {

    }

    public function findAll(): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'teams', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $teams = [];

        foreach($data as $team){
            $team['championship'] = $this->championshipRepository->findById($team['championship']);
            $teams[] = TeamFactory::build($team);
        }

        return $teams;
    }

    public function findById(int $id)
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'teams?id=eq.' . $id, [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $data[0]['championship'] = $this->championshipRepository->findById($data[0]['championship']);
        $data = TeamFactory::build($data[0]);

        return $data;
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
    }
}
