<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;
use PHPUnit_Framework_TestCase;

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

	public function testNormalItemQualityDecreaseBy1()
	{
		$item = new Item(['name' => 'Regular Item', 'sellIn' => 5, 'quality' => 10]);

        $item = $this->updateItem($item);

		$this->assertEquals(9, $item->quality);
	}

    /**
     * @param Item $item
     * @return Item
     */
	private function updateItem( Item $item ): Item {
		$program = new Program([$item]);
		$program->updateItemProperties();
		return $program->getItems()[0];
	}

	public function testItemQualityIsNeverNegative()
	{
		$item = new Item(['name' => 'Regular Item', 'sellIn' => 5, 'quality' => 0]);
        $item = $this->updateItem($item);

		$this->assertEquals(0, $item[0]->quality);
	}


    public function testSellDatePassedCausesQualityToDeclineTwiceFast()
    {
        $item = new Item(['name' => 'Regular Item', 'sellIn' => 0, 'quality' => 10]);

        $item = $this->updateItem($item);

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(8, $item->quality);

    }
}

