<?php

namespace GildedRose\DataProvider;

use GildedRose\Item;

/**
 * provides items that are sold in the shop
 */
class ItemsProvider
{

    private static $data = [
        array(
            'name' => "+5 Dexterity Vest",
            'sellIn' => 10,
            'quality' => 20,
        ),
        array(
            'name' => "Aged Brie",
            'sellIn' => 2,
            'quality' => 0,
        ),
        array(
            'name' => "Elixir of the Mongoose",
            'sellIn' => 5,
            'quality' => 7,
        ),
        array(
            'name' => "Sulfuras, Hand of Ragnaros",
            'sellIn' => 0,
            'quality' => 80,
        ),
        array(
            'name' => "Backstage passes to a TAFKAL80ETC concert",
            'sellIn' => 15,
            'quality' => 20,
        ),
        array(
            'name' => "Conjured Mana Cake",
            'sellIn' => 3,
            'quality' => 6,
        )
    ];

    /**
     * returns available items
     *
     * @return Item[]
     */
    public static function getItems()
    {
        $items = [];
        foreach (self::$data as $item) {
            $items[] = new Item($item);
        }

        return $items;
    }
}