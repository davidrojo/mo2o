<?php

namespace App\Controller;

use App\Repository\BeerRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $page = intval($request->get('page', 1));
        if (!filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])){
            throw new BadRequestHttpException('Page parameter must be a positive integer');
        }

        return $this->repository->searchByFood($query, $page);
    }

    /**
     * @Rest\View(serializerGroups={"details"})
     * @param $id
     * @return null
     */
    public function getAction($id){
        $beer = $this->repository->findOneById($id);
        if (!$beer){
            throw new NotFoundHttpException('No beer found with the id '.$id);
        }

        return $beer;
    }
}