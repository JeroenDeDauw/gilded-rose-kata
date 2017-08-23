<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 22.08.17
 * Time: 19:01
 */

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class ProgramTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_updates_quality_property_of_items()
    {
        $items = [
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
        ];

        $program = new Program($items);
        $program->UpdateQuality();

        $processedItems = $program->getItems();

        $this->assertSame(9, $processedItems[0]->sellIn);
        $this->assertSame(19, $processedItems[0]->quality);

        $this->assertSame(1, $processedItems[1]->sellIn);
        $this->assertSame(1, $processedItems[1]->quality);

        $this->assertSame(4, $processedItems[2]->sellIn);
        $this->assertSame(6, $processedItems[2]->quality);

        $this->assertSame(0, $processedItems[3]->sellIn);
        $this->assertSame(80, $processedItems[3]->quality);

        $this->assertSame(14, $processedItems[4]->sellIn);
        $this->assertSame(21, $processedItems[4]->quality);

        $this->assertSame(2, $processedItems[5]->sellIn);
        $this->assertSame(5, $processedItems[5]->quality);
    }

    /**
     * @test
     */
//    public function it_updates_conjured_items_twice_as_fast()
//    {
//        $items = [
//            new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 3, 'quality' => 6)),
//        ];
//
//        $program = new Program($items);
//        $program->UpdateQuality();
//
//        $processedItems = $program->getItems();
//
//        $this->assertSame(2, $processedItems[0]->sellIn);
//        $this->assertSame(4, $processedItems[0]->quality);
//    }

	/**
	 * @test
	 */
	public function it_decreases_quality_of_normal_item_by_one()
	{
		$items = [
			new Item(array('name' => "normal item", 'sellIn' => 3, 'quality' => 6)),
		];

		$program = new Program($items);
		$program->UpdateQuality();

		$processedItems = $program->getItems();

		$this->assertSame(5, $processedItems[0]->quality);
	}

	/**
	 * @test
	 */
	public function it_decreases_sell_in_of_normal_item_by_one()
	{
		$item = $this->update_item(new Item(array('name' => "normal item", 'sellIn' => 3, 'quality' => 6)));

		$this->assertSame(2, $item->sellIn);
	}

	private function update_item(Item $item): Item {
		$program = new Program([$item]);
		$program->UpdateQuality();
		return $program->getItems()[0];
	}

    /**
     * @test
     */
    public function it_degrades_quality_twice_as_fast_after_sell_date_passed()
    {
        $item = $this->update_item(new Item(array('name' => "normal item", 'sellIn' => -1, 'quality' => 6)));

        $this->assertSame(4, $item->quality);
	}
}
