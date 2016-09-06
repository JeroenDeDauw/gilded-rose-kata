<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    function testUpdateQuality()
    {
        $app = new Program(array(
            new Item(array('name' => "+5 Dexterity Vest", 'sellIn' => 10, 'quality' => 20)),
            new Item(array('name' => "Aged Brie", 'sellIn' => 2, 'quality' => 0)),
            new Item(array('name' => "Elixir of the Mongoose", 'sellIn' => 5, 'quality' => 7)),
            new Item(array('name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 0, 'quality' => 80)),
            new Item(array(
                'name' => "Backstage passes to a TAFKAL80ETC concert",
                'sellIn' => 15,
                'quality' => 20
            )),
            new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 3, 'quality' => 6)),
        ));

        $app->UpdateQuality();
        $items = $app->getItems();

        foreach ($items as $item) {
           if( $item->name == "Conjured Mana Cake")
           {
               $this->assertEquals(2,$item->sellIn);
               $this->assertEquals(4,$item->quality);

           };
        }
    }
}

