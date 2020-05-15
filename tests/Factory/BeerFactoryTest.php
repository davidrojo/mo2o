<?php

namespace App\Tests\Factory;

use App\Factory\BeerFactory;
use PHPUnit\Framework\TestCase;

class BeerFactoryTest extends TestCase
{
    public function testCreateBeer(){
        $params = [
            'id' => 12,
            'name' => 'Avery Brown Dredge',
            'description' => 'An Imperial Pilsner...',
            'image_url' => 'https://images.punkapi.com/v2/5.png',
            'tagline' => 'Bloggers Imperial Pilsner.',
            'first_brewed' => '02/2011'
        ];

        $beer = BeerFactory::createFromArray($params);
        $this->assertEquals($beer->getId(), $params['id']);
        $this->assertEquals($beer->getName(), $params['name']);
        $this->assertEquals($beer->getDescription(), $params['description']);
        $this->assertEquals($beer->getImageUrl(), $params['image_url']);
        $this->assertEquals($beer->getTagline(), $params['tagline']);
        $this->assertEquals($beer->getFirstBrewed(), $params['first_brewed']);
    }

}