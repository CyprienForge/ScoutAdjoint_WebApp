<?php

namespace Infrastructure\Repository\Supabase;

use Domain\Entity\Player;
use Domain\Factory\PlayerFactory;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class PlayerRepositorySupabase implements PlayerRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private TeamRepository $teamRepository,
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
        $players = [];

        foreach($data as $player){
            $player['team'] = $this->teamRepository->findById($player['team']);
            $players[] = PlayerFactory::build($player);
        }

        return $players;
    }

    public function findById(int $id): ?Player
    {
        return null;
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
    }

    public function findPaginated(int $limit, int $offset, ?string $firstName, ?string $lastName)
    {
        // TODO: Implement findPaginated() method.
    }
}
