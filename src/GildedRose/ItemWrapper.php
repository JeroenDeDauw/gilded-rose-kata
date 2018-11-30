<?php

namespace GildedRose;

class ItemWrapper implements ItemBehavior {

	private $item;

	public function __construct(Item $item) {
		$this->item = $item;
	}

	public function getItem(): Item {
		return $this->item;
	}

	public function dailyItemUpdate() {
		$this->item = $this->calculate($this->getItem());
	}

	private function calculate(Item $oldItem): Item {
		return new Item(); // TODO: add logic
	}

}