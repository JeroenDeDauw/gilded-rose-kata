<?php
class AgedBrie extends \GildedRose\Item
{
    public function __construct(array $parts)
    {
        $parts['sellIn'] = $parts['sellIn'] - 1;

        if ($parts['quality'] < 50) {
            $parts['quality'] = $parts['quality'] + 1;
            if ($parts['sellIn'] < 0) {
                $parts['quality'] = $parts['quality'] + 1;
            }

        }




        parent::__construct($parts);
    }

}
