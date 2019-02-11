<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

	public function testQualityDecreases() {
		$item = new Item(array('name' => "+5 Dexterity Vest", 'sellIn' => 10, 'quality' => 20));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(19, $item->quality);
	}

  public function testConjuredQualityDecreases() {
    $item = new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 10, 'quality' => 20));

    $program = new Program([$item]);
    $program->UpdateQuality();

    $this->assertSame(18, $item->quality);
  }

	public function testSellDateDecreases() {
		$item = new Item(array('name' => "Normal item", 'sellIn' => 10, 'quality' => 20));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(9, $item->sellIn);
	}


  public function testQualityDecreasesTwiceWhenSellDatePassed() {
    $item = new Item(array('name' => "Normal item", 'sellIn' => 0, 'quality' => 42));

    $program = new Program([$item]);
    $program->UpdateQuality();

    $this->assertSame(40, $item->quality);
  }

  public function testConjuredQualityDecreasesTwiceWhenSellDatePassed() {
    $item = new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 0, 'quality' => 42));

    $program = new Program([$item]);
    $program->UpdateQuality();

    $this->assertSame(38, $item->quality);
  }

	public function testQualityIsNeverNegative() {
		$item = new Item(array('name' => "Normal item", 'sellIn' => 0, 'quality' => 0));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(0, $item->quality);
	}

	public function testAgedBrieIncreasesInQuality() {
		$item = new Item(array('name' => "Aged Brie", 'sellIn' => 1, 'quality' => 10));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(11, $item->quality);
	}

	public function testQualityNeverAbove50() {
    $item = new Item(array('name' => "Aged Brie", 'sellIn' => 0, 'quality' => 50));

    $program = new Program([$item]);
    $program->UpdateQuality();

    $this->assertSame(50, $item->quality);
  }

	public function testSulfurasNeverChanges() {
		$item = new Item(array('name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 23, 'quality' => 42));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame(42, $item->quality);
		$this->assertSame(23, $item->sellIn);
	}

	public function testWhenQualityDecreasesTwiceDoesntBecomeNegative() {
    $item = new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 10, 'quality' => 0));

    $program = new Program([$item]);
    $program->UpdateQuality();

    $this->assertSame(0, $item->quality);
  }

  public function testWhenSellDateIsZeroQualityDoesntBecomeNegative() {
    $item = new Item(array('name' => "Normal item", 'sellIn' => 0, 'quality' => 0));

    $program = new Program([$item]);
    $program->UpdateQuality();

    $this->assertSame(0, $item->quality);
  }

}

