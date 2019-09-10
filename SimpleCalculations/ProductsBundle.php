<?php
namespace SimpleCalculations;

class ProductsBundle
{
    /** @var Product[]  */
    protected $products = [];

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function getTotal()
    {
        $total = 0.0;
        foreach ($this->products as $product) {
            $total += $product->getTotal();
        }
        return $total;
    }
}