<?php

namespace Infrastructure\Repository\Supabase;

use Domain\Entity\Championship;
use Domain\Factory\ChampionshipFactory;
use Domain\Repository\ChampionshipRepository;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChampionshipRepositorySupabase implements ChampionshipRepository
{
    public function __construct(
        private HttpClientInterface $client,
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
            $this->apiUrl . 'championships', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $championships = [];

        foreach($data as $championship){
            $championships[] = ChampionshipFactory::build($championship);
        }

        return $championships;
    }

    public function findById(int $id)
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'championships?id=eq.' . $id, [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey
                ]
            ]
        );

        $data = $response->toArray();
        $data = ChampionshipFactory::build($data[0]);

        return $data;
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function findByName(string $name): ?ChampionshipDoctrine
    {
        return null;
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
    }
}
