<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    public function test_main() {
        $a = "HELLO
                                              Name -  SellIn - Quality
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                            Elixir of the Mongoose -       4 -       6
                        Sulfuras, Hand of Ragnaros -       0 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
                                Conjured Mana Cake -       2 -       4
";
        $this->expectOutputString($a);
        Program::Main();
    }

    public function test_limit_0() {
		$a = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20));

		$program = new Program([$a]);

		for ( $i = 0; $i < 21; $i++ ) {
			$program->UpdateQuality();
		}

		$this->assertSame( 0, $program->items[0]->quality );
    }

    // Test for limits 0
    // Test for limits 50
//    public function test_limit_0() {
//		$a = new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20));
//
//		$program = new Program([$a]);
//
//		for ( $i = 0; $i < 21; $i++ ) {
//			$program->UpdateQuality();
//		}
//
//		$this->assertSame( 0, $program->items[0]->quality );
//    }
}

