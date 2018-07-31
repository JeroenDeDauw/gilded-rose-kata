<?php

namespace GildedRose\Tests;

use GildedRose\Items\AbstractItem;
use GildedRose\Items\CheeseItem;
use GildedRose\Items\CommonItem;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{


    public function itemProvider() {
        yield 'common item' => [
            new CommonItem([
                    'name' => 'commonitem',
                    'sellIn' => 20,
                    'quality' => 20]
            ),
            19
        ];

        yield 'Cheese item' => [
            new CheeseItem([
                'name' => "Aged Brie",'sellIn' => 2,'quality' => 0
            ]),
            1
        ];
    }

    /**
     * @dataProvider itemProvider
     */
    public function testItemQuality(AbstractItem $item, int $expectedQuality) {
        $programm = new Program([]);

        $actualItem = $programm->updateItemQuality($item);

        $this->assertSame($expectedQuality, $actualItem->quality);
    }
}

