<?php
declare(strict_types=1);

namespace App;

use App\Strategy\ConcertStrategy;
use App\Strategy\LegendaryStrategy;
use App\Strategy\RegularStrategy;
use App\Strategy\StrategyInterface;
use App\Strategy\WellAgingStrategy;

final class GildedRose
{


    public function updateItem(Item $item): void
    {
        $strategy = $this->pickStrategy($item);
        $item->quality = $strategy->recalculateQuality($item);
        if ($strategy->shouldDecrementSellIn()) {
            $item->sellIn--;
        }
    }

    private function pickStrategy(Item $item): StrategyInterface
    {
        return match ($item->name) {
            'Aged Brie',
                => new WellAgingStrategy(),

            'Sulfuras, Hand of Ragnaros',
                => new LegendaryStrategy(),

            'Backstage passes to a TAFKAL80ETC concert',
                => new ConcertStrategy(),

            default => new RegularStrategy(),
        };
    }
}