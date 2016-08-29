<?php

namespace GildedRose\Tests;

use GildedRose\QualityProcessor;
use GildedRose\Item;

class QualityProcessorTest extends GildedRoseTestCase
{
    public function testUpdateQuality()
    {
        $cls = new QualityProcessor();

        $item = new Item(array('name' => 'Something', 'quality' => 10, 'sellIn' => 10));

        $cls->updateQuality($item);

        $this->assertSame(9, $item->quality);
        $this->assertSame(9, $item->sellIn);
    }
}