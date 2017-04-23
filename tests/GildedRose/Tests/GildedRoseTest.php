<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

	public function testUpdateQuality() {
		$item = new Item( ['name' => "foobar",'sellIn' => 10,'quality' => 20] );

		$program = new Program( [ $item ] );

		$program->UpdateQuality();

		$this->assertSame( 19, $item->quality );
	}

}

