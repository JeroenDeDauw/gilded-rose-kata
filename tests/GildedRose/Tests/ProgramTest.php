<?php

namespace GildedRose\Tests;

use GildedRose\Program;

class ProgramTest extends \PHPUnit_Framework_TestCase
{
    public function testMain()
    {
        ob_start();
        Program::Main();
        $output = ob_get_clean();

        $expected = "HELLO\n" .
        "                                              Name -  SellIn - Quality\n" .
        "                                 +5 Dexterity Vest -       9 -      19\n".
        "                                         Aged Brie -       1 -       1\n" .
        "                            Elixir of the Mongoose -       4 -       6\n" .
        "                        Sulfuras, Hand of Ragnaros -       0 -      80\n" .
        "         Backstage passes to a TAFKAL80ETC concert -      14 -      21\n" .
        "                                Conjured Mana Cake -       2 -       5\n";

        $this->expectOutputString($expected);
    }
}
