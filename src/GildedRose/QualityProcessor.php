<?php

namespace GildedRose;

class QualityProcessor
{
    /**
     * @param  Item $item
     * @return void
     */
    public function updateQuality(Item $item)
    {
        $item->quality--;
        $item->sellIn--;
    }
}