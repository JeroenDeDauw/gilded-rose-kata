<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

	public function testRunningUpdateQualityDoesNotCauseAnyErrors()
	{
		$program = new Program([]);
		$program->UpdateQuality();
		$this->assertTrue(true);
	}

	public function testDecreasesSellInAndQualityByOne()
	{
		$item = new Item(array('name' => "test",'sellIn' => 10,'quality' => 20));

		$program = new Program([$item]);
		$program->UpdateQuality();
		$this->assertEquals(9, $item->sellIn);
		$this->assertEquals(19, $item->quality);
	}

	public function testWhenSellInZeroOrLess_qualityDecreasesByTwo()
	{
		$item = new Item(array('name' => "test",'sellIn' => 0,'quality' => 20));
		$program = new Program([$item]);
		$program->UpdateQuality();
		$this->assertEquals(18 , $item->quality);
	}

	public function testWhenQualityIsZero_qualityDoesNotDecrease()
	{
		$item = new Item(array('name' => "test",'sellIn' => 10,'quality' => 0));
		$program = new Program([$item]);
		$program->UpdateQuality();
		$this->assertEquals(0 , $item->quality);
	}

	public function testWhenQualityWouldDecreaseByMoreThanOne_qualityStillDoesNotGoBelowZero()
	{
		$item = new Item(array('name' => "test",'sellIn' => 0,'quality' => 1));
		$program = new Program([$item]);
		$program->UpdateQuality();
		$this->assertEquals(0 , $item->quality);
	}

    public function testWhenItemIsLegendary_qualityDoesNotDecrease()
    {
        $item = new Item(array('name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 10,'quality' => 10));
        $program = new Program([$item]);
        $program->UpdateQuality();
        $this->assertEquals(10, $item->quality);

    }
}

