<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class WellAgingStrategy implements StrategyInterface
{


    public function shouldDecrementSellIn(): bool
    {
        return true;
    }

    /**
     * Well aging items always gain quality - 1 each day, and 2 each day after their sell date.
     * Minimum quality: 0
     * Maximum quality: 50
     */
    public function recalculateQuality(Item $item): int
    {
        $modifier = $item->sellIn <= 0 ? 2 : 1;
        return max(0, min(50, $item->quality + $modifier));
    }
}