<?php

namespace App\Controller;

use App\Service\PunkApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/beers")
 */
class BeerController extends AbstractController
{
    /** @var PunkApiClient */
    private $api;

    public function __construct(PunkApiClient $api)
    {
        $this->api = $api;
    }

    /**
     * @Route("/search", name="api_beer_search")
     */
    public function searchAction(Request $request){
        $query = $request->get('query', null);
        if(!$query){
            throw new BadRequestHttpException('You must provide a query to search');
        }

        $r = $this->api->searchByFood($query);
        dd($r);
    }
}