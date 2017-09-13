<?php

namespace GildedRose\Tests;

use GildedRose\CategorizedItem;
use GildedRose\Program;
use phpDocumentor\Reflection\DocBlock\Tags\operty;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalItemQualityDecrease()
    {
        $item = new CategorizedItem("+5 Dexterity Vest",10,20, CategorizedItem::CAT_NORMAL);

        $program = new Program([$item]);
        $program->UpdateQuality();

        $this->assertSame(19, $item->quality);
    }

}

