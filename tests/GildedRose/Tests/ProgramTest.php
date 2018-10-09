<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{

    public function testConjuredQualityDecreasesTwiceAsFast()
    {
        $item = new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 3, 'quality' => 6));

        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(4, $item->quality);
    }

    public function testNormalItemBeforeSellDatePasses()
    {
        $item = new Item(array('name' => "Normal Item", 'sellIn' => 3, 'quality' => 6));
        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(5, $item->quality);
    }

    public function testNormalItemAfterSellDatePasses() {
        $item = new Item(array('name' => "Normal Item", 'sellIn' => 0, 'quality' => 6));
        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(4, $item->quality);
    }

    public function testAgedBrieIncreasesInQualityTheOlderItGets() {
        $item = new Item(array('name' => "Aged Brie",'sellIn' => 2,'quality' => 0));
        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(1, $item->quality);
    }

    public function testAgedBrieDoesNotIncreaseInQualityBeyond50() {
        $item = new Item(array('name' => "Aged Brie",'sellIn' => 2,'quality' => 50));
        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(50, $item->quality);
    }

    public function testSulfurasNeverChangesInQuality() {
        $item = new Item(array('name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 2,'quality' => 10));
        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(10, $item->quality);
    }

    public function testSulfurasCanHaveQualityAbove50() {
        $item = new Item(array('name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 2,'quality' => 80));
        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(80, $item->quality);
    }

    //- "Backstage passes", like aged brie, increases in Quality as it's
    //  SellIn value approaches; Quality increases by 2 when there are 10 days or less
    //  and by 3 when there are 5 days or less but Quality drops to 0 after the concert

}

