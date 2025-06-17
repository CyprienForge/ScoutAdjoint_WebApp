<?php

namespace Infrastructure\Repository\Teams;

use Domain\Factory\TeamFactory;
use Domain\Repository\TeamRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TeamRepositorySupabase implements TeamRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private string $apiUrl,
        private string $apiKey
    ){}
    public function save($item): void
    {

    }

    public function findAll(): array
    {
        return [];
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
        $data = TeamFactory::build($data[0]);

        return $data;
    }
}
