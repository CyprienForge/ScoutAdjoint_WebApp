<?php

namespace Infrastructure\Service\APIFootball;

use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class ApiFootballProvider
{
    protected HttpClientInterface $client;
    public function __construct(
        private string $apiKey,
        HttpClientInterface $client
    )
    {
        $this->client = $client->withOptions([
            'headers' => [
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => $this->apiKey,
            ]
        ]);
    }

}
