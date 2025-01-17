<?php

namespace App;

final class Item
{


    function __construct(
        public string $name,
        public int    $sellIn,
        public int    $quality
    )
    {

    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}