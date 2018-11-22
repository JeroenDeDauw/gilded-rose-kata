<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

	public function testSellInValueDecreases() {
		$items = [
			new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
			new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
			new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
			new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
			new Item(array(
				'name' => "Backstage passes to a TAFKAL80ETC concert",
				'sellIn' => 15,
				'quality' => 20
			))
		];

		$program = new Program( $items );

		$program->UpdateQuality();

		$this->assertSame( 9, $items[0]->sellIn );
		$this->assertSame( 1, $items[1]->sellIn );
		$this->assertSame( 4, $items[2]->sellIn );
		$this->assertSame( 0, $items[3]->sellIn );
		$this->assertSame( 14, $items[4]->sellIn );
	}

	public function testQualityDecreases()
	{
		$items = [
			new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
			new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7))
		];

		$program = new Program( $items );

		$program->UpdateQuality();

		$this->assertSame( 19, $items[0]->quality );
		$this->assertSame( 6, $items[1]->quality );
	}

	public function testBackstageIncreaseBy2WhenSellInLessThan10()
	{
		$backStageItem = new Item(array(
			'name' => "Backstage passes to a TAFKAL80ETC concert",
			'sellIn' => 10,
			'quality' => 20
		));

		$items = [$backStageItem];

		$program = new Program( $items );

		$program->UpdateQuality();

		$this->assertSame(22, $backStageItem->quality);
	}

	public function testBackstageIncreaseBy2WhenSellInLessThan5()
	{
		$backStageItem = new Item(array(
			'name' => "Backstage passes to a TAFKAL80ETC concert",
			'sellIn' => 5,
			'quality' => 20
		));

		$items = [$backStageItem];

		$program = new Program( $items );

		$program->UpdateQuality();

		$this->assertSame(23, $backStageItem->quality);
	}

	public function testBackstageQualityDropsTo0SellInPasses()
	{
		$backStageItem = new Item(array(
			'name' => "Backstage passes to a TAFKAL80ETC concert",
			'sellIn' => 0,
			'quality' => 20
		));

		$items = [$backStageItem];

		$program = new Program( $items );

		$program->UpdateQuality();

		$this->assertSame(0, $backStageItem->quality);
	}

	public function testQualityDoesNotGoBelowZero() {
		$item = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 0));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(0, $item->quality);
	}

	public function testQualityDoesNotGoBelowZeroWhenSellInPasses() {
		$item = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 0,'quality' => 0));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(0, $item->quality);
	}

	public function testQualityDecreaseTwiceAsFastWhenSellInPasses()
	{
		$item = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 0,'quality' => 10));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(8, $item->quality);
	}

	public function testSulfurasSellInNeverDecreases() {
		$item = new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 10,'quality' => 80));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(10, $item->sellIn);
	}

	public function testConjuredQualityDecreaseBy2()
	{
		$item = new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(4, $item->quality);
	}

	public function testConjuredQualityDecreaseBy4WhenSellInPasses()
	{
		$item = new Item(array('name' => "Conjured Mana Cake",'sellIn' => 0,'quality' => 6));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(2, $item->quality);
	}
}

