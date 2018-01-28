<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
	public function testStuff() {
		$testItems = [
			new Item( [ 'name' => "+5 Dexterity Vest", 'sellIn' => 10, 'quality' => 20 ] ),
			new Item( [ 'name' => "Aged Brie", 'sellIn' => 2, 'quality' => 0 ] ),
			new Item( [ 'name' => "Elixir of the Mongoose", 'sellIn' => 5, 'quality' => 7 ] ),
			new Item( [ 'name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 0, 'quality' => 80 ] ),
			new Item( [ 'name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => 15, 'quality' => 20 ] ),
			new Item( [ 'name' => "Conjured Mana Cake", 'sellIn' => 3, 'quality' => 6 ] ),
		];

		$program = new Program( $testItems );
		$program->UpdateQuality();

		$this->assertEquals(

		);
	}
}

