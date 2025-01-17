<?php

namespace App;

final class GildedRose
{


    const ITEM_WELL_AGING = 'Aged Brie';
    const ITEM_LEGENDARY = 'Sulfuras, Hand of Ragnaros';
    const ITEM_CONCERT = 'Backstage passes to a TAFKAL80ETC concert';

    public function updateItem(Item $item): void
    {
        if ($item->name == self::ITEM_LEGENDARY) {
            return;
        }

        $item->sellIn = $item->sellIn - 1;
        if ($item->sellIn < 0) {
            $this->handleExpired($item);
        } else {
            $this->updateQuality($item);
        }

        if ($item->quality > 50) {
            $item->quality = 50;
        } else if ($item->quality < 0) {
            $item->quality = 0;
        }
    }

    private function handleExpired(Item $item): void
    {
        switch ($item->name) {
            case self::ITEM_WELL_AGING: {
                $item->quality += 2;
                break;
            }
            case self::ITEM_CONCERT: {
                $item->quality = 0;
                break;
            }
            default: {
                $item->quality -= 2;
            }
        }
    }

    private function updateQuality(Item $item): void
    {
        switch ($item->name) {
            case self::ITEM_WELL_AGING: {
                $item->quality++;

                break;
            }
            case self::ITEM_CONCERT: {
                $is10DaysOrLess = $item->sellIn < 10;
                $is5DaysOrLess = $item->sellIn < 5;

                if ($is5DaysOrLess) {
                    $item->quality += 3;
                } else if ($is10DaysOrLess) {
                    $item->quality += 2;
                } else {
                    $item->quality++;
                }

                break;
            }
            default: {
                $item->quality--;
            }
        }
    }

}