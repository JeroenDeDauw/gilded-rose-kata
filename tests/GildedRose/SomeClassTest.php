<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use GildedRose\SomeClass;
use PHPUnit\Framework\TestCase;

/**
 * @see Program
 */
class SomeClassTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldUpdateQuality()
    {
        $someObject = new SomeClass();
		$items =  [
			new Item(['name' => "+5 Dexterity Vest", 'sellIn' => 10, 'quality' => 20]),
			new Item(['name' => "Aged Brie", 'sellIn' => 2, 'quality' => 0]),
			new Item(['name' => "Elixir of the Mongoose", 'sellIn' => 5, 'quality' => 7]),
			new Item(['name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 0, 'quality' => 80]),
			new Item(
				[
					'name' => "Backstage passes to a TAFKAL80ETC concert",
					'sellIn' => 15,
					'quality' => 20
				]
			),
			new Item(['name' => "Conjured Mana Cake", 'sellIn' => 3, 'quality' => 6]),
		];

        $this->assertEquals(
        	[
				new Item(['name' => "+5 Dexterity Vest", 'sellIn' => 9, 'quality' => 19]),
				new Item(['name' => "Aged Brie", 'sellIn' => 1, 'quality' => 1]),
				new Item(['name' => "Elixir of the Mongoose", 'sellIn' => 4, 'quality' => 6]),
				new Item(['name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 0, 'quality' => 80]),
				new Item(
					[
						'name' => "Backstage passes to a TAFKAL80ETC concert",
						'sellIn' => 14,
						'quality' => 21
					]
				),
				new Item(['name' => "Conjured Mana Cake", 'sellIn' => 2, 'quality' => 5]),
            ],
			$someObject->passDay( $items )
		);
    }
}
