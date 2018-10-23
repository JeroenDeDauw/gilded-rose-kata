<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    public function testItemDecreasesInQualityByOne()
    {
        $normalItem = new Item(array( 'name' => "Normal Item",'sellIn' => 10,'quality' => 20));
        $program = new Program([$normalItem]);
        $program->UpdateQuality();
        $this->assertEquals(19, $normalItem->quality);
    }
    
    public function testItemDecreasesInQualityByTwoWhenSellInDateHasPassed()
    {
        $normalItem = new Item(array( 'name' => "Normal Item",'sellIn' => -1,'quality' => 20));
        $program = new Program([$normalItem]);
        $program->UpdateQuality();
        $this->assertEquals(18, $normalItem->quality);
    }

    public function testItemQualityNeverNegative()
    {
        $normalItem = new Item(array( 'name' => "Normal Item",'sellIn' => 10,'quality' => 0));
        $program = new Program([$normalItem]);
        $program->UpdateQuality();
        $this->assertEquals(0, $normalItem->quality);
    }

	public function testConjuredItemDecreasesByFourWhenSellInDateHasPassed()
	{
		$normalItem = new Item(array( 'name' => "Conjured Mana Cake",'sellIn' => -1,'quality' => 8));
		$program = new Program([$normalItem]);
		$program->UpdateQuality();
		$this->assertEquals(4, $normalItem->quality);
	}

	public function testConjuredItemDecreasesByTwo()
	{
		$normalItem = new Item(array( 'name' => "Conjured Mana Cake",'sellIn' => 1,'quality' => 8));
		$program = new Program([$normalItem]);
		$program->UpdateQuality();
		$this->assertEquals(6, $normalItem->quality);
	}

	public function testConjuredItemQualityNeverNegative()
	{
		$normalItem = new Item(array( 'name' => "Conjured Mana Cake",'sellIn' => -1,'quality' => 3));
		$program = new Program([$normalItem]);
		$program->UpdateQuality();
		$this->assertEquals(0, $normalItem->quality);
	}
}
