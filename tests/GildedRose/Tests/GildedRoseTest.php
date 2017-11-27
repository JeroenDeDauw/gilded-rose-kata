<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
	public function testQualityIsNeverBelowZero() {
		$item = new Item([ 'name' => "Normal item",'sellIn' => 10,'quality' => 0 ]);

		( new Program( [ $item ] ) )->UpdateQuality();

		$this->assertSame( 0, $item->quality );
    }

	public function testAgedBrieQualityIncreases()
	{
		$item = new Item(['name' => "Aged Brie", 'sellIn' => 10, 'quality' => 0]);

		(new Program([$item]))->UpdateQuality();

		$this->assertSame(1, $item->quality);
	}

	public function testQualityIsNeverOver50()
	{
		$item = new Item(['name' => "Aged Brie", 'sellIn' => 10, 'quality' => 50]);

		(new Program([$item]))->UpdateQuality();

		$this->assertSame(50, $item->quality);
	}
}
