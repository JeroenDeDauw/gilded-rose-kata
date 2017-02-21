<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct_test()
    {
        // prepare
        $items = [
            new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
            new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
        ];
        $classUnderTest = new Program($items);

        // test
        $classUnderTest::Main();

        // verify

    }

    /**
     * @test
     */
	public function testUpdateQuality_emptyItem()
	{
		$item = new Item([]);
		$program = new Program([]);

		$resultItem = $program->UpdateQuality($item);

		$this->assertEquals(
			new Item([]),
			$resultItem
		);
    }

    /**
     * @test
     */
    public function testUpdateQuality_simpleItemQualityDecreaseBy1()
    {
        $item = new Item([
            'name' => 'someName',
            'sellIn' => 11,
            'quality' => 19
        ]);
        $expectedResult = 18;
        $program = new Program([]);

        $resultItem = $program->UpdateQuality($item);

        $this->assertEquals(
            $expectedResult,
            $resultItem->quality
        );
    }

    /**
     * @test
     */
    public function testUpdateQuality_simpleItemSellInDecreaseBy1()
    {
        $item = new Item([
            'name' => 'someName',
            'sellIn' => 11,
            'quality' => 19
        ]);
        $expectedResult = 10;
        $program = new Program([]);

        $resultItem = $program->UpdateQuality($item);

        $this->assertEquals(
            $expectedResult,
            $resultItem->sellIn
        );
    }

}

