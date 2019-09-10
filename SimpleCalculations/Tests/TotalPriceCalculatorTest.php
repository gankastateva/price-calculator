<?php
namespace SimpleCalculations\Tests;

use PHPUnit\Framework\TestCase;
use SimpleCalculations\Product;
use SimpleCalculations\ProductsBundle;
use SimpleCalculations\TotalPriceCalculator;

class TotalPriceCalculatorTest extends TestCase
{
    CONST KEYBOARD = 'Keyboard';
    CONST MOUSE = 'Mouse';
    CONST HEADPHONES = 'Headphones';
    CONST PEN = 'Pen';

    public function testSimpleProduct()
    {
        $keyboard = new Product(self::KEYBOARD, 100.45);
        $calculator = new TotalPriceCalculator([$keyboard]);
        $total = $calculator->getTotal();

        $this->assertEquals($total, 100.45);
    }

    public function testBundle()
    {
        $keyboard = new Product(self::KEYBOARD, 100.45);
        $mouse = new Product(self::MOUSE, 25.68);
        $firstBundle = new ProductsBundle([$keyboard, $mouse]);

        $calculator = new TotalPriceCalculator([$keyboard, $mouse, $firstBundle]);
        $total = $calculator->getTotal();

        $this->assertEquals($total, 252.26);
    }

    public function testMultipleBundle()
    {
        $keyboard = new Product(self::KEYBOARD, 1);
        $mouse = new Product(self::MOUSE, 2);
        $pen = new Product(self::PEN, 3);
        $firstBundle = new ProductsBundle([$keyboard, $mouse, $pen]); // 6
        $secondBundle = new ProductsBundle([$keyboard, $mouse, $firstBundle]); // 1 + 2 + 6 = 9
        $thirdBundle = new ProductsBundle([$firstBundle, $secondBundle]); // 6 + 9 = 15

        $calculator = new TotalPriceCalculator([$keyboard, $mouse, $firstBundle, $thirdBundle]); // 1 + 2 + 6 + 15 = 24
        $total = $calculator->getTotal();

        $this->assertEquals($total, 24);
    }

    public function testCombination()
    {
        $keyboard = new Product(self::KEYBOARD, 10);
        $mouse = new Product(self::MOUSE, 5);
        $headphones = new Product(self::HEADPHONES, 8);
        $firstBundle = new ProductsBundle([$keyboard, $mouse]);
        $secondBundle = new ProductsBundle([$firstBundle, $headphones]);

        $calculator = new TotalPriceCalculator([$keyboard, $mouse, $secondBundle, $firstBundle]);
        $total = $calculator->getTotal();

        $this->assertEquals($total, 53);
    }
}
