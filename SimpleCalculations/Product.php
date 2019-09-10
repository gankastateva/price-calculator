<?php
namespace SimpleCalculations;

class Product
{
    protected $name;
    protected $price = 0.0;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getTotal()
    {
        return $this->price;
    }
}