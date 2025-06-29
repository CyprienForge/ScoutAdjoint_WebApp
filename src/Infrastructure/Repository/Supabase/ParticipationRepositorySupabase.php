<?php

namespace Infrastructure\Repository\Supabase;

use Domain\Factory\ParticipationFactory;
use Domain\Repository\MatchRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ParticipationRepositorySupabase implements ParticipationRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private string $apiUrl,
        private string $apiKey,
        private PlayerRepository $playerRepository,
        private MatchRepository $matchRepository,
        private TeamRepository $teamRepository,
    ){}

    public function save($item): void
    {
        // TODO: Implement save() method.
    }

    public function findAll(): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'participations', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $participations = [];

        foreach($data as $participation){
            $participation['player'] = $this->playerRepository->findById($participation['player']);
            $participation['match'] = $this->matchRepository->findById($participation['match']);
            $participation['team'] = $this->teamRepository->findById($participation['team']);
            $participations[] = ParticipationFactory::build($participation);
        }

        return $participations;
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
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
