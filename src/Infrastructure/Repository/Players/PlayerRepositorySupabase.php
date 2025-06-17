<?php

namespace Infrastructure\Repository\Players;

use Domain\Entity\Player;
use Domain\Repository\PlayerRepository;
use Domain\Repository\Repository;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class PlayerRepositorySupabase implements PlayerRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private string $apiUrl,
        private string $apiKey
    ){}

    /**
     * @param Player $player
     */
    public function save($player) : void
    {

    }

    public function findAll(): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'players', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        return $data;
    }

    public function findById(int $id): ?Player
    {
        return null;
    }
}
