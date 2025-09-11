<?php

namespace Infrastructure\Service\GoogleAPISearch;

use Domain\Entity\Player;
use Domain\Service\LinkProfileTransfermarkt\LinkProfileTransfermarktSearcher;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleApiLinkProfileTransfermarktSearcher implements LinkProfileTransfermarktSearcher
{
    public function __construct(private HttpClientInterface $http, private string $apiKey, private string $cx){}

    public function searchLinkProfileTransfermarkt(Player $player) : string
    {
        $searchCriterias = $player->getFirstName() . ' ' . $player->getLastName() . ' Transfermarkt';

        $response = $this->http->request('GET', 'https://www.googleapis.com/customsearch/v1', [
            'query' => [
                'key' => $this->apiKey,
                'q' => $searchCriterias,
                'cx' => $this->cx
            ]
        ]);

        $data = $response->toArray();

        return $data['items'][0]['link'];
    }
}
