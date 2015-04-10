<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
	public function testGivenSellDateHasPassed_qualityDegradesTwiceAsFast()
    {
		$item = new Item(array("name" => "test", "sellIn" => 0, "quality" => 6));
        $this->assertItemQuality($item, 4);
	}

	public function testGivenZeroQuality_qualityRemainsZero()
	{
		$item = new Item(array("name" => "test", "sellIn" => 5, "quality" => 0));
        $this->assertItemQuality($item, 0);
	}

    public function testGivenAgedBrie_qualityIncreases()
    {
        $item = new Item(array("name" => "Aged Brie", "sellIn" => 2, "quality" => 6));
        $this->assertItemQuality($item, 7);
    }

    protected function assertItemQuality($item, $expectedQuality)
    {
        $items = array($item);
        $program = new Program($items);
        $program->UpdateQuality();
        $this->assertEquals($expectedQuality, $item->quality);
    }

	public function testGivenAgedBrieWithQuality50_qualityDoesNotGoAbove50()
	{
		$item = new Item(array("name" => "Aged Brie", "sellIn" => 2, "quality" => 50));
		$this->assertItemQuality($item, 50);
	}

    public function testGivenSulfuras_qualityAndSellInDoesNotDecrease()
    {
        $item = new Item(array("name" => "Sulfuras, Hand of Ragnaros", "sellIn" => 2, "quality" => 80));
        $this->assertItemQuality($item, 80);
        $this->assertEquals(2, $item->sellIn);
    }

	public function testWhenSellInDateOfBackstagePassesIsBetween10and5_qualityIncreasesByTwo()
	{
		$item = new Item(array("name" => "Backstage passes to a TAFKAL80ETC concert", "sellIn" => 9, "quality" => 10));
		$this->assertItemQuality($item, 12);
	}

	public function testWhenSellInDateOfBackstagePassesIs10_qualityIncreasesByTwo()
	{
		$item = new Item(array("name" => "Backstage passes to a TAFKAL80ETC concert", "sellIn" => 10, "quality" => 10));
		$this->assertItemQuality($item, 12);
	}

    public function testWhenSellInDateOfBackstagePassesIsBetween5And1_qualityIncreasesByThree()
    {
        $item = new Item(array("name" => "Backstage passes to a TAFKAL80ETC concert", "sellIn" => 3, "quality" => 10));
        $this->assertItemQuality($item, 13);
    }

    public function testWhenSellInDateOfBackstagePassesIs5_qualityIncreasesByThree()
    {
        $item = new Item(array("name" => "Backstage passes to a TAFKAL80ETC concert", "sellIn" => 5, "quality" => 10));
        $this->assertItemQuality($item, 13);
    }

    public function testWhenSellInDateOfBackstagePassesIs0_qualityIsSetToZero()
    {
        $item = new Item(array("name" => "Backstage passes to a TAFKAL80ETC concert", "sellIn" => 0, "quality" => 10));
        $this->assertItemQuality($item, 0);
    }

	public function testWhenSellInDateOfBackstagePassesAbove10_qualityIncreasesByOne()
	{
		$item = new Item(array("name" => "Backstage passes to a TAFKAL80ETC concert", "sellIn" => 11, "quality" => 10));
		$this->assertItemQuality($item, 11);
	}

    public function testGivenItem_sellInDecreases()
    {
        $item = new Item(array("name" => "test", "sellIn" => 2, "quality" => 50));
        $items = array($item);
        $program = new Program($items);
        $program->UpdateQuality();
        $this->assertEquals(1, $item->sellIn);
    }

}

