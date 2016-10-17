<?php

namespace GildedRose;

class ShopItem extends Item
{

	/**
	 * indicates how much the item degrades in quality over time
     *
	 * @var float
	 */
	private $qualityDecreaseCoefficient = 1;

	public function updateQuality()
	{

	}

}

