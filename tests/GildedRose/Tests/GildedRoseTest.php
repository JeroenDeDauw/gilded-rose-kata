<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
  public function testUpdateQuality() {
    $items = array(new Item(array( 'name' => '+5 Dexterity Vest','sellIn' => 10,'quality' => 20)));

    $program = new Program($items);

    $program->UpdateQuality();

    $this->assertEquals(10 - 1, $items[0]->sellIn);
  }
}

