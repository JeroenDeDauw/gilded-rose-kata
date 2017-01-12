<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase {

	public function testMainFunction() {
		Program::Main();

		$this->expectOutputString("HELLO
                                              Name -  SellIn - Quality
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                            Elixir of the Mongoose -       4 -       6
                        Sulfuras, Hand of Ragnaros -       0 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
                                Conjured Mana Cake -       2 -       5
");


	}

	public function testStuff() {
		$item = new Item(['name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20]);

		$this->assertEquals( 9, $item->quality );
	}

}

