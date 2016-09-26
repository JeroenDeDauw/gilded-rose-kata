<?php
namespace GildedRose;

Interface ItemContainerInterface {
    //public  function setItem(Item $item);
    public function __construct(Item $item);
    public function updateQuality();
    public function getName();
    public function get
}
