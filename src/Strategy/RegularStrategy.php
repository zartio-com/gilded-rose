<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class RegularStrategy implements StrategyInterface
{


    public function shouldDecrementSellIn(): bool
    {
        return true;
    }

    /**
     * Regular items lose 1 quality each day, and 2 quality each day after their sell date.
     * Minimum quality: 0
     * Maximum quality: 50
     */
    public function recalculateQuality(Item $item): int
    {
        $modifier = $item->sellIn <= 0 ? -2 : -1;
        return max(0, min(50, $item->quality + $modifier));
    }
}