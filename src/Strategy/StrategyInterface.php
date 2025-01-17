<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Item;

interface StrategyInterface
{


    public function shouldDecrementSellIn(): bool;

    public function recalculateQuality(Item $item): int;
}