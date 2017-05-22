<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

	private function getProgram(): Program {
		return new Program( [
			new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
			new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
			new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
			new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
			new Item(array(
				'name' => "Backstage passes to a TAFKAL80ETC concert",
				'sellIn' => 15,
				'quality' => 20
			)),
			new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
		] );
    }

	public function testUpdatingQuality() {
		$program = $this->getProgram();

		$program->UpdateQuality();

		$expectedItems = [
			new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 9,'quality' => 19)),
			new Item(array( 'name' => "Aged Brie",'sellIn' => 1,'quality' => 1)),
			new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 4,'quality' => 6)),
			new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
			new Item(array(
				'name' => "Backstage passes to a TAFKAL80ETC concert",
				'sellIn' => 14,
				'quality' => 21
			)),
			new Item(array('name' => "Conjured Mana Cake",'sellIn' => 2,'quality' => 5)),
		];

		$this->assertEquals( $expectedItems, $program->getItems() );
    }
}

