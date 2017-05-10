<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    public function testPositiveQuality(){
      $item = new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0));
      $app = new Program( array( $item ) );
      $app->UpdateQuality();

      $this->assertGreaterThan( 0, $item->quality );
	}
}
