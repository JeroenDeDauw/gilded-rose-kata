<?php

namespace GildedRose\Tests;

use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function main() {
        ob_start();
        Program::Main();
        $mainResult = ob_get_clean();

		$this->assertContains('
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                            Elixir of the Mongoose -       4 -       6
                        Sulfuras, Hand of Ragnaros -       0 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
                                Conjured Mana Cake -       2 -       5',
            $mainResult);
    }

}

