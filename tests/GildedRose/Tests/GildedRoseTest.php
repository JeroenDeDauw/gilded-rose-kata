<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Program
     */
    protected $sut;

    public function setUp()
    {
        $this->sut = new Program(array(
            new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
            new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
            new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
            new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
            new Item(array(
                'name' => "Backstage passes to a TAFKAL80ETC concert",
                'sellIn' => 15,
                'quality' => 20
            )),
            new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
        ));
    }

    public function testGoldMaster()
    {
        $this->sut->UpdateQuality();

        $output = [
            '+5 Dexterity Vest' => ['sellIn' => 9 , 'quality' => 19],
            'Aged Brie'  => ['sellIn' => 1 , 'quality' => 1],
            'Elixir of the Mongoose' => ['sellIn' => 4 , 'quality' => 6],
            'Sulfuras, Hand of Ragnaros' => ['sellIn' => 0 , 'quality' => 80],
            'Backstage passes to a TAFKAL80ETC concert' => ['sellIn' => 14 , 'quality' => 21],
            'Conjured Mana Cake' => ['sellIn' => 2 , 'quality' => 5],
        ];

        // foreach item assert values
        foreach ($this->sut->getItems() as $item) {
            $this->assertArrayHasKey(
                $item->name,
                $output,
                sprintf("Actual item %s isn't in the expected output", $item->name)
            );

            $expectedOutput = $output[$item->name];

            $this->assertEquals($item->sellIn, $expectedOutput['sellIn']);
            $this->assertEquals($item->quality, $expectedOutput['quality']);
        }
    }

	public function testConjuredItemsDegradeInQualityTwiceAsFast() {
		$program = new Program(array(
			new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
		));

		$program->UpdateQuality();

		$this->assertSame( 4, $program->getItems()[0]->quality );
    }

}

