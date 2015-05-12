<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

    public function testGivenNormalItem_qualityIsDecreasedByOne()
    {
        $item = new Item(['name' => "test", 'sellIn' => 10, 'quality' => 20]);

        $this->updateQualityOfItem($item);

        $this->assertSame(19, $item->quality);
    }

    public function testGivenAgedBrie_qualityIsIncreasedByOne()
    {

        $item = new Item(['name' => "Aged Brie", 'sellIn' => 10, 'quality' => 20]);

        $this->updateQualityOfItem($item);
        $this->assertSame(21, $item->quality);

    }


    public function testGivenBackstagePass_qualityIsIncreasedWithinTheLastDays()
    {
        $item = new Item(['name' => "Backstage passes to a TAFKAL80ETC concert", 'sellIn' => 10, 'quality' => 20]);

        $this->updateQualityOfItem($item);
        $this->assertSame(21, $item->quality);


    }


    private function updateQualityOfItem(Item $item)
    {

        $app = new Program([$item]);
        $app->UpdateQuality();

    }


}

