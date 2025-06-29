<?php

namespace Infrastructure\Repository\Supabase;

use Domain\Factory\MatchFactory;
use Domain\Repository\MatchRepository;
use Domain\Repository\TeamRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MatchRepositorySupabase implements MatchRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private TeamRepository $teamRepository,
        private string $apiUrl,
        private string $apiKey
    ){}
    public function save($item): void
    {
        // TODO: Implement save() method.
    }

    public function findAll(): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'matchs', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $matchs = [];

        foreach($data as $match){
            $match['home_team'] = $this->teamRepository->findById($match['home_team']);
            $match['away_team'] = $this->teamRepository->findById($match['away_team']);
            $matchs[] = MatchFactory::build($match);
        }

        return $matchs;
    }

    public function findById(int $id)
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'matchs?id=eq.' . $id, [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $data[0]['home_team'] = $this->teamRepository->findById($data[0]['home_team']);
        $data[0]['away_team'] = $this->teamRepository->findById($data[0]['away_team']);
        $data = MatchFactory::build($data[0]);

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
