<?php

namespace GildedRose;

class LegendaryItemQualityWatcher
{
    private $item;

    /**
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
            throw new \InvalidArgumentException();
        }

        $this->item = $item;
    }


    public function UpdateQuality()
    {
        // do nothing
    }

}
