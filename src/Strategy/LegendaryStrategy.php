<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class LegendaryStrategy implements StrategyInterface
{


    public function shouldDecrementSellIn(): bool
    {
        return false;
    }

    /**
     * Legendary item's quality is always 80
     * Minimum quality: 80
     * Maximum quality: 80
     */
    public function recalculateQuality(Item $item): int
    {
        return 80;
    }
}