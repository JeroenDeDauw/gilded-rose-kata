<?php

namespace GildedRose;


class CategorizedItem extends Item
{
	private $category;

	const CAT_NORMAL = 'normal';

	public function __construct($name, $sellIn, $quality, $category)
	{
		parent::__construct(['name' => $name,'sellIn' => $sellIn, 'quality' => $quality]);
		$this->category = $category;
	}

}
