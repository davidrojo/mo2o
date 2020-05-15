<?php

namespace App\Controller;

use App\Repository\BeerRepository;
use App\Service\PunkApiClient;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends AbstractFOSRestController implements ClassResourceInterface
{
    /** @var BeerRepository */
    private $repository;


    public function __construct(BeerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Rest\View(serializerGroups={"list"})
     */
    public function searchAction(Request $request){
        $query = $request->get('query', null);
        if(!$query){
            throw new BadRequestHttpException('You must provide a query to search');
        }

        return $this->repository->searchByFood($query);
    }

    /**
     * @Rest\View(serializerGroups={"list"})
     */
    public function getAction($id){

    }
}