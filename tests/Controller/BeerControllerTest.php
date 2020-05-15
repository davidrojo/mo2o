<?php

namespace App\Tests\Controller;

use App\Repository\BeerRepository;
use App\Service\PunkApiClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BeerControllerTest extends WebTestCase
{

    public function testSearchBadParameters(){
        $client = static::createClient();

        $client->request('GET', '/api/beers/search');
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/beers/search?query=');
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }

    public function testSearchBadPageParameters(){
        $client = static::createClient();

        // Negative
        $client->request('GET', '/api/beers/search?query=d&page=-1');
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

        // Zero
        $client->request('GET', '/api/beers/search?query=d&page=0');
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

        // Text value
        $client->request('GET', '/api/beers/search?query=d&page=text');
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());

        // Decimal value
        $client->request('GET', '/api/beers/search?query=d&page=0.8');
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }
}