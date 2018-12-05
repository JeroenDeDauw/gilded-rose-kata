<?php

namespace GildedRose;

class Program
{
    private $items = array();

    public static function Main()
    {
        echo "HELLO\n";

        $app = new Program(array(
              new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
              new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
              new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
              new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
              new Item(array(
                     'name' => "Backstage passes to a TAFKAL80ETC concert",
                     'sellIn' => 15,
                     'quality' => 20
              )),
              new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
        ));

        $app->UpdateQuality();

        echo sprintf("%50s - %7s - %7s\n", "Name", "SellIn", "Quality");
        foreach ($app->items as $item) {
            echo sprintf("%50s - %7d - %7d\n", $item->name, $item->sellIn, $item->quality);
        }
    }

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function UpdateQuality()
    {
        for ($i = 0; $i < count($this->items); $i++) {
            if ($this->items[$i]->name != "Aged Brie" && $this->items[$i]->name != "Backstage passes to a TAFKAL80ETC concert") {
                if ($this->items[$i]->quality > 0) {
                    if ($this->items[$i]->name != "Sulfuras, Hand of Ragnaros") {
                        $this->items[$i]->quality = $this->items[$i]->quality - 1;
                    }
                }
            } else {
                if ($this->items[$i]->quality < 50) {
                    $this->items[$i]->quality = $this->items[$i]->quality + 1;

                    if ($this->items[$i]->name == "Backstage passes to a TAFKAL80ETC concert") {
                        if ($this->items[$i]->sellIn < 11) {
                            if ($this->items[$i]->quality < 50) {
                                $this->items[$i]->quality = $this->items[$i]->quality + 1;
                            }
                        }

                        if ($this->items[$i]->sellIn < 6) {
                            if ($this->items[$i]->quality < 50) {
                                $this->items[$i]->quality = $this->items[$i]->quality + 1;
                            }
                        }
                    }
                }
            }

            $this->sulfurasUpdate($this->items[$i]);

            $this->sellInLessThan0qualityUpdate($this->items[$i]);
        }
    }

   public function sulfurasUpdate($itemUpdating) {
        if ($itemUpdating->name != "Sulfuras, Hand of Ragnaros") {
            $itemUpdating->sellIn = $itemUpdating->sellIn - 1;
        }
   }

   public function sellInLessThan0qualityUpdate(Item $item) {
       if ($item->sellIn < 0) {
           if ($item->name != "Aged Brie") {
               if ($item->name != "Backstage passes to a TAFKAL80ETC concert") {
                   if ($item->quality > 0) {
                       if ($item->name != "Sulfuras, Hand of Ragnaros") {
                           $item->quality = $item->quality - 1;
                       }
                   }
               } else {
                   $item->quality = $item->quality - $item->quality;
               }
           } else {
               if ($item->quality < 50) {
                   $item->quality = $item->quality + 1;
               }
           }
       }
   }
    
}
