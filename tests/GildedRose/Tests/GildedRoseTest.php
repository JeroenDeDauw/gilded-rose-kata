<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Program
     */
    private $program;

    public function setUp() {
        $this->program = new Program([]);
    }

    public function testUpdateBrieQuality() {
        $item = new Item(array( 'name' => Program::AGED_BRIE,'sellIn' => 2,'quality' => 0));
        $this->program->UpdateQuality($item);
        $this->assertSame($item->quality, 1);
    }
}

