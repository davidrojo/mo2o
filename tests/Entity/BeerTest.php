<?php

namespace App\Tests\Entity;

use App\Entity\Beer;
use PHPUnit\Framework\TestCase;

class BeerTest extends TestCase
{
    public function testConstruct(){
        $b = new Beer(12);
        $this->assertEquals(12, $b->getId());
    }
}