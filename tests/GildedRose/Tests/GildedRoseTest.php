<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testAgedBrieIncreasesInQualityTheOlderItGets() {
        $item = new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0));

        $program = new Program( [ $item ] );
        $program->UpdateQuality();

        $this->assertSame( 1, $item->quality );
    }

    public function testNormalItemDecreasesInQualityBy1() {
        $item = new Item(array( 'name' => "normal item",'sellIn' => 2,'quality' => 1));

        $program = new Program( [ $item ] );
        $program->UpdateQuality();

        $this->assertSame( 0, $item->quality );
    }

    /**
     * @dataProvider increasingItemProvider
     */
    public function testQualityOfAnItemNeverGoesOver50( string $itemName ) {
        $item = new Item(array(
            'name' => $itemName,
            'sellIn' => 15,
            'quality' => 50
        ));

        $program = new Program( [ $item ] );
        $program->UpdateQuality();

        $this->assertSame( 50, $item->quality );
    }

    public function increasingItemProvider() {
        yield [ "Backstage passes to a TAFKAL80ETC concert" ];
        yield [ "Aged Brie" ];
    }

    public function testNormalItemQualityNeverNegative() {
        $item = new Item(array( 'name' => "normal item",'sellIn' => 2,'quality' => 0));

        $program = new Program( [ $item ] );
        $program->UpdateQuality();

        $this->assertSame( 0, $item->quality );
    }

    public function testNormalItemQualityDegradesByTwoWhenSellByDateHasPassed() {
        $item = new Item(array( 'name' => "normal item",'sellIn' => 0,'quality' => 2));

        $program = new Program( [ $item ] );
        $program->UpdateQuality();

        $this->assertSame( 0, $item->quality );
    }

}

