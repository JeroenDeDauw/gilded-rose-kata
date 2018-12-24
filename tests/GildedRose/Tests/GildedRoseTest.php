<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function assertQualityAfterOneDay(int $expectedQuality, Item $item) {
        $program = new Program([$item]);
        $program->UpdateQuality();
        $this->assertSame($expectedQuality, $item->quality);
    }

    public function testNormalItem()
    {
        $this->assertQualityAfterOneDay(
            19,
            new Item(array('name' => '+5 Dexterity Vest','sellIn' => 10,'quality' => 20))
        );
    }

	public function testAgedBrie()
	{
        $this->assertQualityAfterOneDay(
            1,
            new Item(array('name' => 'Aged Brie','sellIn' => 2,'quality' => 0))
        );
	}

	public function testSulfuras()
	{
		$this->assertQualityAfterOneDay(
			80,
			new Item(array('name' => 'Sulfuras, Hand of Ragnaros','sellIn' => 0,'quality' => 80))
		);
	}

	public function testBackstagePasses()
	{
		$this->assertQualityAfterOneDay(
			21,
            new Item(array(
                'name' => 'Backstage passes to a TAFKAL80ETC concert',
                'sellIn' => 15,
                'quality' => 20
            ))
		);
	}

	public function testBackstagePassesIncreaseInQualityByTwo()
	{
		$this->assertQualityAfterOneDay(
			22,
			new Item(array(
				'name' => 'Backstage passes to a TAFKAL80ETC concert',
				'sellIn' => 10,
				'quality' => 20
			))
		);
	}
}

