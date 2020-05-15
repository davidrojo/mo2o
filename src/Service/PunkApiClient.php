<?php

namespace App\Service;

use App\Factory\BeerFactory;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PunkApiClient
{
    private const RPP = 25;

    /** @var HttpClientInterface */
    private $client;
    private $punkApiBaseUrl;

    public function __construct($punkApiBaseUrl)
    {
        $this->client = HttpClient::create();
        $this->punkApiBaseUrl = $punkApiBaseUrl;
    }

    public function searchByFood($food, $page = 1, $rpp = self::RPP){
        $response = $this->client->request('GET', $this->punkApiBaseUrl.'/beers', [
            'query' => [
                'food' => $food,
                'page' => $page,
                'per_page' => $rpp
            ]
        ]);

        if($response->getStatusCode() != Response::HTTP_OK){
            throw new \Exception('Error making api request');
        }

        $list = $response->toArray();
        return array_map(function($array) { return BeerFactory::createFromArray($array); }, $list);
    }
}