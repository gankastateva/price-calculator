<?php


class TotalPriceCalculator
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function getTotal()
    {
        $total = 0.0;
        /** @var Product|ProductsBundle $entry */
        foreach ($this->products as $entry) {
            $total += $entry->getTotal();
        }
        return $total;
    }
}