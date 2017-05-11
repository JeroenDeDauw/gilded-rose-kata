<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
	public function testOnceSellByDateHasPassed_conjuredQualityDegradesBy4() {
		$item = new Item(['name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6]);

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame( 2, $item->quality );
	}

	public function testOnceSellByDateHasPassed_normalItemQualityDegradesBy2() {
		$item = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => -1,'quality' => 20));

		$program = new Program([$item]);
		$program->UpdateQuality();

		$this->assertSame( 18, $item->quality );
	}
	
}
