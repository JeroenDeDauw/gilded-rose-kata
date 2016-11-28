<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Program
	 */
	private $program;

	public function setUp() {
		$this->program = new Program(array(
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
		));
	}

	public function testUpdateQuality() {
		$this->program->UpdateQuality();

		foreach ( $this->program->getItems() as $item ) {
			if ($item->name === '+5 Dexterity Vest') {
				$this->assertEquals( 19, $item->quality );
				$this->assertEquals( 9, $item->sellIn );
			}
			if ($item->name === 'Aged Brie') {
				$this->assertEquals( 1, $item->quality );
				$this->assertEquals( 1, $item->sellIn );
			}
			// ...
		}
	}

}

