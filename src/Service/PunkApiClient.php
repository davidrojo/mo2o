<?php

namespace App\Service;

use App\Exception\PunkApiException;
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
        $list = $this->request($this->punkApiBaseUrl.'/beers', [
            'query' => [
                'food' => $food,
                'page' => $page,
                'per_page' => $rpp
            ]
        ]);

        return array_map(function($array) { return BeerFactory::createFromArray($array); }, $list);
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
    private function request($path, $params){
        try{
            $response = $this->client->request('GET', $path, $params);

            if($response->getStatusCode() != Response::HTTP_OK){
                throw new Exception('Error retrieving data');
            }

            return $response->toArray();
        }
        catch (Exception $e){
            throw new Exception('Error retrieving data');
        }
    }
}