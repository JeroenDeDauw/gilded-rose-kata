<?php

class ItemDescription {
    public $item;
    public $minQuality;
    public $maxQuality;
    public $qualityChange;

//- "Backstage passes", like aged brie, increases in Quality as it's
//SellIn value approaches; Quality increases by 2 when there are 10 days or less
//and by 3 when there are 5 days or less but Quality drops to 0 after the concert

    function __construct() {
        $this->qualityChange = array(
            365 => 1,
            10 => 2,
            5 => 3,
            1 => $this->item->maxQuality,
        );
    }
}