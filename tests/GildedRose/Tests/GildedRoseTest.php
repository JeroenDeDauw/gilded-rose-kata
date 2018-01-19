<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private function updateItem(Item $item) {
        $testProgram = new Program([$item]);
        $testProgram->UpdateQuality();
    }

    function testNormalItemDecreasesInQualityByOne()
    {
        $testItem = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20));
		$this->updateItem($testItem);
        $this->assertSame(19, $testItem->quality);
    }

    function testAgedBrieIncreasesInQualityByOne() {
        $testItem = new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0));
		$this->updateItem($testItem);
        $this->assertSame(1, $testItem->quality);
    }

    function testSulfurasDoesNotModifyQuality() {
        $testItem = new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80));
        $this->updateItem($testItem);
        $this->assertSame(80, $testItem->quality);
    }

    function testWhenBackstagePassesHaveSellInOverTenDaysTheyIncreasesInQualityByOne() {
        $testItem = new Item(array(
			'name' => "Backstage passes to a TAFKAL80ETC concert",
			'sellIn' => 11,
			'quality' => 20
		));
        $this->updateItem($testItem);
        $this->assertSame(21, $testItem->quality);
    }

    function testWhenBackstagePassesHaveSellInUnderElevenDaysTheyIncreasesInQualityByTwo() {
        $testItem = new Item(array(
            'name' => "Backstage passes to a TAFKAL80ETC concert",
            'sellIn' => 10,
            'quality' => 20
        ));
        $this->updateItem($testItem);
        $this->assertSame(22, $testItem->quality);
    }
}

