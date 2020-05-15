<?php

namespace App\Service;

use App\Factory\BeerFactory;
use App\Repository\BeerRepository;
use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PunkApiClient implements BeerRepository
{
    /** @var HttpClientInterface */
    private $client;
    private $punkApiBaseUrl;

    public function __construct($punkApiBaseUrl)
    {
        $this->client = HttpClient::create();
        $this->punkApiBaseUrl = $punkApiBaseUrl;
    }

    public function searchByFood($food, $page = 1, $rpp = self::RPP){
        $list = $this->request('/beers', [
            'query' => [
                'food' => $food,
                'page' => $page,
                'per_page' => $rpp
            ]
        ]);

        return array_map(function($array) { return BeerFactory::createFromArray($array); }, $list);
    }

    public function findOneById($id)
    {
        $beer = $this->request('/beers/'.$id);
        // Punk api returns an array of items when requesting a single item, so
        // we check that the result contains exactly one item
        if ($beer && is_array($beer) && count($beer) == 1){
            return BeerFactory::createFromArray($beer[0]);
        }

        return null;
    }


    /**
     * Encapsulates the api request to handle errors and return the response in array format
     *
     * @param $path
     * @param $params
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    private function request($path, $params = []){
        try{
            $response = $this->client->request('GET', $this->punkApiBaseUrl.$path, $params);

            if ($response->getStatusCode() == Response::HTTP_NOT_FOUND){
                return null;
            }
            if($response->getStatusCode() == Response::HTTP_OK){
                return $response->toArray();
            }

            throw new Exception('Error retrieving data');
        }
        catch (Exception $e){
            throw new Exception('Error retrieving data 2');
        }
    }
}