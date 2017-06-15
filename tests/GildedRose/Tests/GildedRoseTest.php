<?php

namespace GildedRose\Tests;



use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    function testSellInValueChanges()
    {
        $item = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20));
        $program = new Program([$item]);
        $program->UpdateQuality();
        $this->assertSame( 9, $item->sellIn );
    }

	function testCanSellBeBelowZero()
	{
		$item = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 0,'quality' => 20));
		$program = new Program([$item]);
		$program->UpdateQuality();
		$this->assertSame( -1, $item->sellIn );
	}
}

