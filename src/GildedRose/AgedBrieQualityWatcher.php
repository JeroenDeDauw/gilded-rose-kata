<?php

namespace GildedRose;

class AgedBrieQualityWatcher
{
    private $item;

    /**
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        if ($item->name !== 'Aged Brie') {
            throw new \InvalidArgumentException();
        }

        $this->item = $item;
    }


    public function UpdateQuality()
    {
		$this->item->sellIn--;
		$this->item->quality += 1;
    }

}
