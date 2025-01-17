<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class ConcertStrategy implements StrategyInterface
{


    public function shouldDecrementSellIn(): bool
    {
        return true;
    }

    /**
     * Concert tickets gain quality, but quality sets to 0 after the concert.
     * - +1 each day
     * - +2 each day 10 days before the concert
     * - +3 each day 5 days before the concert
     * Minimum quality: 0
     * Maximum quality: 50
     */
    public function recalculateQuality(Item $item): int
    {
        if ($item->sellIn <= 0) {
            return 0;
        }

        return max(0, min(50, $item->quality + $this->getQualityModifier($item->sellIn)));
    }

    private function getQualityModifier(int $sellIn): int
    {
        if ($sellIn <= 5) {
            return 3;
        } else if ($sellIn <= 10) {
            return 2;
        }

        return 1;
    }
}