<?php

namespace App\Factory;

use App\Entity\Beer;

class BeerFactory
{
    public static function createFromArray($array){
        $beer = new Beer($array['id']);

        $beer->setName($array['name'])
            ->setDescription($array['description'])
            ->setFirstBrewed($array['first_brewed'])
            ->setImageUrl($array['image_url'])
            ->setTagline($array['tagline']);

        return $beer;
    }
}