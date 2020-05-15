<?php

namespace App\Repository;

interface BeerRepository
{
    public const RPP = 25;

    public function searchByFood($food, $page = 1, $rpp = self::RPP);
}