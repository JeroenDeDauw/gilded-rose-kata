<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase {

	public function testNormalItem_qualityDoesNotGoBelowZero() {
		$normalItem = new Item( [
			'name' => "+5 Dexterity Vest",
			'sellIn' => 0,
			'quality' => 0,
		] );
		$app = new Program( [ $normalItem ] );
		$app->UpdateQuality();
		$this->assertSame( 0, $normalItem->quality );
		$this->assertSame( -1, $normalItem->sellIn );
	}

	public function testNormalItem_qualityDecreasesTwiceAfterSellIn() {
		$normalItem = new Item( [
			'name' => "+5 Dexterity Vest",
			'sellIn' => 0,
			'quality' => 20,
		] );
		$app = new Program( [ $normalItem ] );
		$app->UpdateQuality();
		$this->assertSame( 18, $normalItem->quality );
		$this->assertSame( -1, $normalItem->sellIn );
	}

	/**
	 * @dataProvider itemTestDataProvider
	 */
	public function testItem( $inputItem, $expectedItem ) {
		$app = new Program( [ $inputItem ] );
		$app->UpdateQuality();
		$this->assertEquals( $expectedItem, $inputItem );
	}

	public function itemTestDataProvider() {
		yield 'normal item quality decreases by one' => [
			new Item( [
				'name' => "+5 Dexterity Vest",
				'sellIn' => 10,
				'quality' => 20,
			] ),
			new Item( [
				'name' => "+5 Dexterity Vest",
				'sellIn' => 9,
				'quality' => 19,
			] )
		];
		yield 'brie item quality increases by one' => [
			new Item( [
				'name' => "Aged Brie",
				'sellIn' => 10,
				'quality' => 20,
			] ),
			new Item( [
				'name' => "Aged Brie",
				'sellIn' => 9,
				'quality' => 21,
			] )
		];
		yield 'the quality of an item is never more than 50' => [
			new Item( [
				'name' => "Aged Brie",
				'sellIn' => 10,
				'quality' => 50,
			] ),
			new Item( [
				'name' => "Aged Brie",
				'sellIn' => 9,
				'quality' => 50,
			] )
		];
	}

}

