<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

    public function testMainMethodReturnsStartOutput() {
        $this->expectOutputString('HELLO
                                              Name -  SellIn - Quality
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                            Elixir of the Mongoose -       4 -       6
                        Sulfuras, Hand of Ragnaros -       0 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
                                Conjured Mana Cake -       2 -       4
');
        Program::Main();
    }

    public function provideItemsAndExpectedValues() {
//        $itemNames = array(
//            '+5 Dexterity Vest',
//            'Aged Brie',
//            'Elixir of the Mongoose',
//            'Sulfuras, Hand of Ragnaros',
//            'Backstage passes to a TAFKAL80ETC concert',
//            'Conjured Mana Cake',
//        );

        $testCases = array(
            'WhenSellInIsZero_qualityDegradesByTwo' => array(
                new Item(array('name' => "normal item",'sellIn' => 0,'quality' => 6)),
                -1,
                4
            ),
			'WhenSellInIsGreaterThanZero_qualityDegradesByOne' => array(
				new Item(array('name' => "normal item",'sellIn' => 5,'quality' => 6)),
				4,
				5
			),
			'WhenQualityIsZero_qualityDoesNotDegrade' => array(
				new Item(array('name' => "normal item",'sellIn' => 5,'quality' => 0)),
				4,
				0
			),
			'WhenQualityIsAboveZeroAndWouldDecreaseByMore_qualityStillNotGoBelowZero' => array(
				new Item(array('name' => "normal item",'sellIn' => 0,'quality' => 1)),
				-1,
				0
			),
			'AgedBrie_qualityIncreasesWithAge' => array(
				new Item(array('name' => "Aged Brie",'sellIn' => 4,'quality' => 4)),
				3,
				5
			),
			'AgedBrie_qualityDoesNotIncreaseAbove50' => array(
				new Item(array('name' => "Aged Brie",'sellIn' => 4,'quality' => 50)),
				3,
				50
			),
			'Sulfuras_qualityNeverChanges' => array(
				new Item(array('name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 25)),
				0,
				25
			),
			'BackstagePasses_whenMoreThan10daysLeft_qualityIncreasesByOne' => array(
				new Item(array('name' => "Backstage passes to a TAFKAL80ETC concert",'sellIn' => 11,'quality' => 25)),
				10,
				26
			),
			'BackstagePasses_whenLessThanOrEqualTo10daysLeft_qualityIncreasesByTwo' => array(
				new Item(array('name' => "Backstage passes to a TAFKAL80ETC concert",'sellIn' => 10,'quality' => 25)),
				9,
				27
			),
			'BackstagePasses_whenLessThanOrEqualTo5daysLeft_qualityIncreasesBy3' => array(
				new Item(array('name' => "Backstage passes to a TAFKAL80ETC concert",'sellIn' => 5,'quality' => 25)),
				4,
				28
			),
			'BackstagePasses_when0DaysLeft_qualityis0' => array(
				new Item(array('name' => "Backstage passes to a TAFKAL80ETC concert",'sellIn' => 0,'quality' => 40)),
				-1,
				0
			),
			'Conjured_qualityDegradesByTwo' => array(
				new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
				2,
				4
			),
			'Conjured_whenQualityIsAboveZeroAndWouldDecreaseByMore_qualityStillNotGoBelowZero' => array(
				new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 1)),
				2,
				0
			),
			'SulfurasQualityNeverChanges' => array(
				new Item(array('name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 3,'quality' => 80)),
				3,
				80
			),
        );
        return $testCases;
    }

    /**
     * @dataProvider provideItemsAndExpectedValues
     */
	public function testUpdateQualityOnSingleItems( Item $item, $expectedSellIn, $expectedQuality ) {
		$app = new Program(array($item));

		$app->UpdateQuality();

		$this->assertSame( $expectedSellIn, $item->sellIn );
		$this->assertSame( $expectedQuality, $item->quality );
	}
}

